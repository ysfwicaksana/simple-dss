<?php

class GlobalCrud extends CI_Model {

    function all($table){
        return $this->db->get($table);
    }

    function get($table,$query){
        return $this->db->get_where($table,$query);
    }

    function insert_batch($table,$query){
      $this->db->insert_batch($table,$query);
    }

    function insert($table,$query){
        $this->db->insert($table,$query);
    }

    function insert_latest($table,$query){
       $this->db->insert($table,$query);
       return $this->db->insert_id();
    }

    function delete($table,$column,$id){
        $this->db->where($column,$id);
        $this->db->delete($table);
    }

    function update($table,$query,$column,$id){
        $this->db->where($column,$id);
        $this->db->update($table,$query);
    }

    function count_table($table){
        return $this->db->count_all($table);
    }

    function twoTablesFusion($table1,$table2,$select,$clause){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2,$clause);
        return $this->db->get();
    }

    function twoTablesFusionCondition($table1,$table2,$select,$clause,$column,$where){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2,$clause);
        $this->db->where($column,$where);
        return $this->db->get();
    }

    function threeTablesFusion($table1,$table2,$table3,$select,$clause1,$clause2){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2,$clause1);
        $this->db->join($table2,$clause2);
        return $this->db->get();
    }

    // function threeTablesFusionCondition($table1,$table2,$table3,$select,$clause1,$clause2){
    //     $this->db->select($select);
    //     $this->db->from($table1);
    //     $this->db->join($table2,$clause1);
    //     $this->db->join($table2,$clause2);
    //     return $this->db->get();
    // }

    function paginate($table,$start,$end){
      $this->db->limit($start,$end);
      return $this->db->get($table);
    }

    function menu($query){
        $this->db->select("menu.menu_name as menu,menu.id as id");
        $this->db->from("modul");
        $this->db->join("menu",'modul.menu = menu.id');
        $this->db->where('modul.id',$query);
        $this->db->group_by('menu.id');
        return $this->db->get();
    }



}
