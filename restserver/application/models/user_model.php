<?php

/**
 * User model
 *
 * @author thupten choephel
 */
class User_model extends CI_Model {

	/**
	 * verifies that token is valid.
	 * every api call to any method returns same set of user table's row. exception would be
	 * sensitive info like 'password'
	 *
	 * @param string $token
	 *        	token key.
	 * @return array | bool returns user array or false.
	 */
	function verify_token($token){
		$users = $this->_get_user(array (
				'token' => $token ));
		if (count($users) > 0){
			$first_record = $users [0];
			$last_seen = (int) $users [0] ['last_seen'];
			$username = $users [0] ['username'];
			$diff_in_sec = now() - $last_seen;
			$seconds_in_2_hr = 2 * 60 * 60;
			if ($diff_in_sec > $seconds_in_2_hr){
				// expired token
				return false;
			} else{
				// auth complete. update timestamp to now.
				$this->update_last_seen_to_now($username);
				return $users [0];
			}
		} else{
			// invalid token
			return false;
		}
	}

	/**
	 * verify username and password
	 *
	 * @param string $username
	 *        	username
	 * @param string $password
	 *        	password
	 * @return string | int | bool token if username and password are correct. returns false if
	 *         not correct.
	 *         returns -1 if login was correct but token could not be generated.
	 */
	function verify_username_password($username, $password){
		$this->db->select('username, token,last_seen');
		$users = $this->_get_user(array (
				'username' => $username,
				'password' => $password ));
		if (count($users) > 0){
			// $query = $this->db->get_where('users', array (
			// 'username' => $username,
			// 'password' => $password ));
			// if ($query->num_rows() == 1){
			// $result_array = $query->result_array();
			// $first_record = $result_array [0];
			$first_record = $users [0];
			$random_token = $this->_regenerate_and_update_token($first_record ['username']);
			if ($random_token != false){
				$first_record ['token'] = $random_token;
				return $first_record;
			} else{
				return - 1;
			}
		} else{
			return false;
		}
	}

	/**
	 * insert a new user to database
	 *
	 * @param array $data
	 *        	an array of $username, $password, $description, $email
	 * @return integer boolean of new user record or false if it fails.
	 */
	function insert_user($data){
		try{
			$username = $data ['username'];
			$this->db->insert('users', $data);
			if ($this->db->affected_rows() > 0){
				$id = $this->db->insert_id();
				$this->db->insert('preferences', array (
						'username' => $username ));
				$this->update_last_seen_to_now($username);
				$users = $this->_get_user(array (
						'id' => $id ));
				return $users;
			} else{
				return false;
			}
		} catch(Exception $error){
			return false;
		}
	}

	/**
	 * get users with where
	 * @param array $where
	 */
	function _get_user($where){
		$query = $this->db->get_where('users', $where);
		$users = $query->result_array();
		foreach($users as &$user){
			$query1 = $this->db->get_where('preferences', array (
					'username' => $user ['username'] ));
			if ($query1->num_rows() > 0){
				$preferences = $query1->result_array();
				$user ['preference'] = $preferences [0];
			}
		}
		return $users;
	}

	private function is_not_empty($element){
		return ($element === "") ? false : true;
	}

	/**
	 * updates user profile
	 *
	 * @param array $data
	 *        	array of user settings
	 * @param array $where
	 *        	where options array
	 *
	 * @return bool returns true if update success or false if it fails
	 */
	function update_user($data, $dataPref, $where){
		$token = $where ['token'];
		$user = $this->verify_token($token);
		$new_data = array_filter($data, array (
				$this,
				'is_not_empty' ));
		$this->db->update('users', $new_data, $where);
		$this->db->update('preferences', $dataPref, array (
				'username' => $user ['username'] ));
		$user = $this->verify_token($token);
		$this->update_last_seen_to_now($user ['username']);
		return $user;
	}

	/**
	 * delete the user
	 *
	 * @param array $where
	 *        	array of username and password
	 * @return boolean returns true or false
	 */
	function delete_user($where){
		$result = $this->verify_username_password($where ['username'], $where ['password']);
		if ($result != false && $result != - 1){
			if ($result ['username'] == $where ['username']){
				try{
					$this->db->delete('users', $where);
					return true;
				} catch(Exception $e){
					return false;
				}
			}
		}
		return false;
	}

	function _regenerate_and_update_token($username){
		$where = array (
				'username' => $username );
		$random_token = random_string('unique', 32);
		$now_timestamp = now();
		$data = array (
				'token' => $random_token,
				'last_seen' => $now_timestamp );
		$this->db->where($where);
		$this->db->update('users', $data);
		if ($this->db->affected_rows() == 1){
			return $random_token;
		}
		return false;
	}

	/**
	 * *
	 * update last seen time to current time.
	 * call this function to keep the api key alive
	 *
	 * @param string $username
	 *        	username
	 */
	function update_last_seen_to_now($username){
		$this->db->where(array (
				'username' => $username ));
		$now = (int) now();
		$this->db->update('users', array (
				'last_seen' => $now ));
	}

	function logout($username){
		$data = array (
				'token' => "" );
		$where = array (
				'username' => $username );
		$this->db->update('user', $data, $where);
		if ($this->db->affected_rows() == 1){
			return true;
		}
		return false;
	}
}