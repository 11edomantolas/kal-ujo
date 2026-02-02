<?php

/* ======================
   AUTH
====================== */

function cek_login()
{
    $ci = get_instance();
    if (!$ci->session->has_userdata('login_session')) {
        set_pesan('Silakan login terlebih dahulu.', false);
        redirect('auth');
    }
}

/* ======================
   ROLE CORE
====================== */

function role()
{
    $ci = get_instance();
    return $ci->session->userdata('login_session')['role'] ?? null;
}

/* ======================
   ROLE CHECK
====================== */

function is_super_admin()
{
    return role() === 'super_admin';
}

function is_admin()
{
    return role() === 'admin';
}

function is_operasional()
{
    return role() === 'operasional';
}

function is_team_leader()
{
    return role() === 'team_leader';
}

function is_finance()
{
    return role() === 'finance';
}

/* ======================
   PERMISSION HANDLER
====================== */

function has_permission($permission)
{
    // Super Admin bypass semua
    if (is_super_admin()) {
        return true;
    }

    return is_callable($permission) ? $permission() : false;
}

/* ======================
   PERMISSION RULES
====================== */

/* ---- MASTER & USER ---- */

function can_manage_master_data()
{
    return is_admin();
}

function can_manage_user()
{
    return is_super_admin();
}

/* ---- UJO (OPERASIONAL) ---- */

function can_view_all_ujo()
{
    return is_operasional() || is_team_leader();
}

function can_create_ujo()
{
    return is_operasional();
}

function can_edit_ujo()
{
    return is_operasional();
}

/* ---- APPROVAL ---- */

function can_approve_ujo()
{
    return is_team_leader();
}

/* ---- KONFIRMASI PEKERJAAN ---- */

function can_confirm_job()
{
    return is_operasional();
}

/* ---- PAYMENT ---- */

function can_process_payment()
{
    return is_finance();
}

function can_view_payment_history()
{
    return is_finance() || is_admin() || is_team_leader();
}



/* ======================
   UTILITIES
====================== */

function set_pesan($pesan, $tipe = true)
{
    $ci = get_instance();
    $class = $tipe ? 'success' : 'danger';

    $ci->session->set_flashdata(
        'pesan',
        "<div class='alert alert-{$class} alert-dismissible fade show'>
            {$pesan}
            <button type='button' class='close' data-dismiss='alert'>
                <span>&times;</span>
            </button>
        </div>"
    );
}

function userdata($field)
{
    $ci = get_instance();
    $ci->load->model('Admin_model', 'admin');

    $userId = $ci->session->userdata('login_session')['user'] ?? null;
    if (!$userId)
        return null;

    $data = $ci->admin->get('user', ['id_user' => $userId]);
    return $data[$field] ?? null;
}

function output_json($data)
{
    $ci = get_instance();
    $ci->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
}
