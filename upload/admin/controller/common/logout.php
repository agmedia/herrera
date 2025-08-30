<?php
class ControllerCommonLogout extends Controller {
	public function index() {

        // Safety: close any impersonation rows tied to this PHP session
        if (function_exists('session_id')) {
            $sid = session_id();
            if ($sid) {
                $this->db->query("UPDATE `" . DB_PREFIX . "impersonation_session`
                                    SET ended_at = NOW(),
                                        duration_seconds = TIMESTAMPDIFF(SECOND, started_at, NOW()),
                                        updated_at = NOW()
                                    WHERE session_id = '" . $this->db->escape($sid) . "'
                                      AND ended_at IS NULL");
            }
        }

		$this->user->logout();

		unset($this->session->data['user_token']);

		$this->response->redirect($this->url->link('common/login', '', true));
	}
}