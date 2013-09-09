<?php
var_dump ( $this->db->last_query () );

if ($this->db->affected_rows () > 0) {
}

$this->db->insert_id ();