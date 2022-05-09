<?php
/* 
 * DB Class 
 * This class is used for database related (connect, insert, update, and delete) operations 
 * with PHP Data Objects (PDO) 
 * @author    CodexWorld.com 
 * @url       http://www.codexworld.com 
 * @license   http://www.codexworld.com/license 
 */
class DB
{
    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbName     = "procedure";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUsername, $this->dbPassword);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "done";
        } catch (PDOException $e) {
            die("Failed to connect with MySQL: " . $e->getMessage());
        }
    }

    public function create($name, $salary, $email, $group_name)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO users(first_name,last_name,email_id,contact_no) VALUES(:fname, :lname, :email, :contact)");
            $stmt->bindparam(":anme", $anme);
            $stmt->bindparam(":salary", $salary);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":contact", $contact);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function getID($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tbl_users WHERE id=:id");
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }
    public function update($id, $anme, $lname, $email, $contactsalary        try {
            $stmt = $this->db->prepare("UPDATE tbl_users SET first_name=:fname, 
                                                 last_name=:lname, 
                                                email_id=:email, 
                                                contact_no=:contact
                                                WHERE id=:id ");
            $stmt->bindparam(":fname", $fname);
            $stmt->bindparam(":lname", $lname);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":contact", $contact);
            $stmt->bindparam(":id", $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM tbl_users WHERE id=:id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return true;
    }



    public function dataview($query)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<tr>
    <td><?php print($row['id']); ?></td>
    <td><?php print($row['first_name']); ?></td>
    <td><?php print($row['last_name']); ?></td>
    <td><?php print($row['email_id']); ?></td>
    <td><?php print($row['contact_no']); ?></td>
    <td align="center">
        <a href="edit-data.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
    </td>
    <td align="center">
        <a href="delete.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
    </td>
</tr>
<?php
            }
        } else {
            ?>
<tr>
    <td>Nothing here...</td>
</tr>
<?php
        }
    }
}