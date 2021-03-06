<?php

class User extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function getUsers()
  {
    $query = $this->db->get('users');
    return $query->result_array();
  }

  public function getUser($column, $value)
  {
    $query = $this->db->get_where('users', array($column => $value));
    return $query->result_array();
  }

  public function insertUser($data)
  {
    $query = $this->db->insert('users', $data);

    $insertedId = $this->db->insert_id();
    $query = $this->db->get_where('users', array('id' => $insertedId));

    return $query->result_array();
  }

  public function getEvents($column, $value)
  {
    $this->db->select('events.*');
    $this->db->from('events');
    $this->db->join('attendance', 'events.id = attendance.eventId');
    $this->db->where('attendance.userId', $value);
    $this->db->order_by('events.id', 'DESC');
    $query = $this->db->get();
    return $query->result_array();
  }
}
