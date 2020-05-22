<?php

    class Chat{
      public $id_chat;
      public $id_group_chat;
      public $message_chat;
      public $sender_id;
      public $table_name = "chat";

      function __construct($dbh){
        $this->dbh = $dbh;
      }

      function select($column1 = 1, $value1 = 1){
        switch($column1) {
            case 'id_chat':
                $col[] = 'id_chat = ?';
                break;
            case 'id_group_chat':
                $col[] = 'id_group_chat = ?';
                break;
            case 'sender_id':
                $col[] = 'sender_id = ?';
                break;
            case 1:
                $col[] = '1 = ?';
                break;
        }
        $sql = "SELECT * FROM $this->table_name";
        // $sql = "SELECT * FROM $this->table_name";
        $end = "ORDER BY id_chat ASC";
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
        $sql = "INSERT INTO $this->table_name (id_group_chat, message_chat, sender_id) VALUES (?,?,?)";

        $this->id_group_chat = htmlspecialchars(strip_tags($this->id_group_chat));
        $this->message_chat = htmlspecialchars(strip_tags($this->message_chat));
        $this->sender_id = htmlspecialchars(strip_tags($this->sender_id));

        if($this->dbh->prepare($sql)->execute([$this->id_group_chat, $this->message_chat, $this->sender_id])){
          return true;
        };
        return false;
      }

      function update(){
        $sql = "UPDATE $this->table_name SET id_group_chat = ?, message_chat = ?, sender_id = ? WHERE id_chat = ?";

        $this->id_group_chat = htmlspecialchars(strip_tags($this->id_group_chat));
        $this->message_chat = htmlspecialchars(strip_tags($this->message_chat));
        $this->sender_id = htmlspecialchars(strip_tags($this->sender_id));
        $this->id_chat = htmlspecialchars(strip_tags($this->id_chat));

        if($this->dbh->prepare($sql)->execute([$this->id_group_chat, $this->message_chat,
                                                $this->sender_id, $this->id_chat])){
          return true;
        }
        return false;
      }

      function delete(){
        $sql = "DELETE FROM $this->table_name WHERE id_chat = ?";

        $this->id_chat = htmlspecialchars(strip_tags($this->id_chat));

        if($this->dbh->prepare($sql)->execute([$this->id_chat])){
          return true;
        }
        return false;
      }
    }


?>
