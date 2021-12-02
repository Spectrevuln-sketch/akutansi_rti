<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user_model extends CI_Model
{
  /* Get Invoice ID */
  public function getId($data)
  {
    return $this->db->get_where('invoice', [
      'id' => $data
    ])->result_array();
  }
  /* End Get Invoice ID */

  /* Get Customer ID */
  public function get_cust_id($id_cust)
  {
    return $this->db->get_where('customer_name', ['id' => $id_cust])->result_array();
  }
  /* End Get Customer ID */

  /* Get Agen ID */
  public function get_agen_id($id_agen)
  {
    return $this->db->get_where('agen_name', ['id' => $id_agen])->result_array();
  }
  /* End Get Agen ID */

  /* Delete Invoice */
  public function deleteInv($data)
  {
    return $this->db->delete('invoice', ['id' => $data]);
  }
  /* End Delete Invoice */

  /* Delete Customer */
  public function delete_cust($data)
  {
    return $this->db->delete('customer_name', ['id' => $data]);
  }
  /* End Delete Customer */

  /* Delete Agen */
  public function delete_agen($data)
  {
    return $this->db->delete('agen_name', ['id' => $data]);
  }
  /* End Delete Agen */

  /* Get All Table Customer */
  public function get_cust_join()
  {
    $customer_name = $this->db->get('customer_name')->result_array();
    return $customer_name;
  }
  /* End Get All Table Customer */

  /* Get All Table Agen */
  public function get_agen_join()
  {
    $agen_name = $this->db->get('agen_name')->result_array();
    return $agen_name;
  }
  /* End Get All Table Agen */
}
