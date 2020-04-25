<?php

    class GroupChat{
      public $id_group_chat;
      public $id_pakar;
      public $id_users;
      public $table_name = "group_chat";

      function __construct($dbh){
        $this->dbh = $dbh;
      }

      function select($column1 = 1, $value1 = 1){
        switch($column1) {
            case 'id_group_chat':
                $col[] = 'id_group_chat = ?';
                break;
            case 'id_pakar':
                $col[] = 'id_pakar = ?';
                break;
            case 'id_users':
                $col[] = 'id_users = ?';
                break;
            case 1:
                $col[] = '1 = ?';
                break;
        }
        $sql = "SELECT * FROM $this->table_name";
        // $sql = "SELECT * FROM $this->table_name";
        $end = "ORDER BY id_group_chat ASC";
        $sql .= " WHERE ".implode(" AND ", $col)." ".$end;
        //echo $sql;
        try{
          $stmt = $this->dbh->prepare($sql);
          $stmt->execute([$value1]);
          // print_r($stmt->fetchAll(\PDO::FETCH_ASSOC));
          return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }catch(PDOException $e){
          echo $e->getMessage();
        }

      }

      function insert(){
        $sql = "INSERT INTO $this->table_name (id_pakar, id_users) VALUES (?,?)";

        $this->id_pakar = htmlspecialchars(strip_tags($this->id_pakar));
        $this->id_users = htmlspecialchars(strip_tags($this->id_users));

        if($this->dbh->prepare($sql)->execute([$this->id_pakar, $this->id_users])){
          return true;
        };
        return false;
      }

      function update(){
        $sql = "UPDATE $this->table_name SET id_pakar = ?, id_users = ? WHERE id_group_chat = ?";

        $this->id_pakar = htmlspecialchars(strip_tags($this->id_pakar));
        $this->id_users = htmlspecialchars(strip_tags($this->id_users));
        $this->id_group_chat = htmlspecialchars(strip_tags($this->id_group_chat));

        if($this->dbh->prepare($sql)->execute([$this->id_pakar, $this->id_users, $this->id_group_chat])){
          return true;
        }
        return false;
      }

      function delete(){
        $sql = "DELETE FROM $this->table_name WHERE id_group_chat = ?";

        $this->id_group_chat = htmlspecialchars(strip_tags($this->id_group_chat));

        if($this->dbh->prepare($sql)->execute([$this->id_group_chat])){
          return true;
        }
        return false;
      }
    }


?>
