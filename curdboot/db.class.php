<?php
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
            $this->conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Failed to connect with MySQL: " . $e->getMessage());
        }
    }

    public function create($name, $salary, $email, $group_name)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO users(name,salary,email,group_name) VALUES(:name, :salary, :email, :group_name)");
            $stmt->bindparam(":name", $name);
            $stmt->bindparam(":salary", $salary);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":group_name", $group_name);
            $stmt->execute();
            echo "test create ok";
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function getByID($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }
    public function update($id, $name, $salary, $email, $group_name)
    {
        $stmt = $this->conn->prepare("UPDATE users SET name=:name,salary=:salary,email=:email,group_name=:group_name WHERE id=:id");
        $stmt->bindparam(":name", $name);
        $stmt->bindparam(":salary", $salary);
        $stmt->bindparam(":email", $email);
        $stmt->bindparam(":group_name", $group_name);
        $stmt->bindparam(":id", $id);
        $stmt->execute();

        echo "test update ok";
        return true;


        // try {
        // } catch (PDOException $e) {
        //     echo $e->getMessage();
        //     return false;
        // }
    }
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id=:id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return true;
    }


    public function searchForGroup($group_search)
    {
        $smt = $this->conn->prepare('SELECT DISTINCT group_name FROM users ORDER BY group_name  DESC');
        $smt->execute();
        $retSearch = $smt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($retSearch as $key => $val) {

            if ($val['group_name'] == $group_search) {
                return ["retval" => $retSearch, "status" => true];
            }
        }
        return ["retval" => $retSearch, "status" => false];
    }

    public function countRowWithValue($searchVal)
    {
        // 'SELECT DISTINCT group_name FROM users ORDER BY group_name ASC'
        // $smt = $this->conn->prepare('SELECT DISTINCT group_name FROM users ORDER BY group_name  DESC');
        // $smt->execute();
        // $retSearch = $smt->fetchAll(PDO::FETCH_ASSOC);
        $res = $this->searchForGroup($searchVal);
        if ($res['status'] == true) {
            $st = $this->conn->prepare("SELECT * FROM users WHERE group_name = :group_name order by id DESC");
            $st->bindValue(':group_name', $searchVal, PDO::PARAM_STR);
            $st->execute();
            $res =  $st->fetchAll(PDO::FETCH_ASSOC);
            return ["result" => $res, "count" => count($res)];
        } else {
            return $this->getAll();
        }
    }


    public function getAll()
    {
        $st = $this->conn->prepare('SELECT * FROM users ORDER BY id DESC');
        $st->execute();
        $res =  $st->fetchAll(PDO::FETCH_ASSOC);
        return ["result" => $res, "count" => count($res)];
    }


    public function  showPerPageData($limit, $offset, $searchVal)
    {
        $res = $this->searchForGroup($searchVal);
        if ($res['status'] == true) {
            $st = $this->conn->prepare('SELECT * FROM users WHERE group_name = :group_name ORDER BY id DESC LIMIT :off, :lim');
            $st->bindValue(':off', $offset, PDO::PARAM_INT);
            $st->bindValue(':lim', $limit, PDO::PARAM_INT);
            $st->bindValue(':group_name', $searchVal, PDO::PARAM_STR);
            $st->execute();
            $res =  $st->fetchAll(PDO::FETCH_ASSOC);
            return ["result" => $res, "count" => count($res)];
        } else {
            $st = $this->conn->prepare('SELECT * FROM users ORDER BY id DESC LIMIT :off, :lim');
            $st->bindValue(':off', $offset, PDO::PARAM_INT);
            $st->bindValue(':lim', $limit, PDO::PARAM_INT);
            $st->execute();
            $res =  $st->fetchAll(PDO::FETCH_ASSOC);
            return ["result" => $res, "count" => count($res)];
        }
    }




    public function paging($limit, $numRows, $page, $url)
    {

        $allPages       = ceil($numRows / $limit);
        $start          = ($page - 1) * $limit;
        $second_last = $allPages - 1;
        $adjacents = "2";
        $previous_page = $page - 1;
        $next_page = $page + 1;

        $querystring = "";

        if ($numRows > $limit) {

            if ($page <= 1) {
                echo '<li class="page-item disabled" aria-disabled="true"><a class="page-link" href="' . $url . 'page=' . $previous_page . '" >First</a></li>';
            } else {
                echo '<li  class="page-item"><a class="page-link" href="' . $url . 'page=1">First</a></li>';

                echo '<li class="page-item"><a class="page-link" href="' . $url . 'page=' . $previous_page . '" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span></a>
                  </li>';
            }

            if ($allPages <= 10) {

                for ($counter = 1; $counter <= $allPages; $counter++) {
                    if ($counter == $page) {
                        echo "<li class='page-item active'><a  class='page-link'>$counter</a></li>";
                    } else {
                        echo "<li class='page-item'><a class='page-link' href='" . $url . "page=" . $counter . "'>$counter</a></li>";
                    }
                }
            } elseif ($allPages > 10) {

                if ($page <= 4) {
                    for ($counter = 1; $counter < 8; $counter++) {
                        if ($counter == $page) {
                            echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                        } else {
                            echo "<li class='page-item'><a class='page-link' href='" . $url . "page=" . $counter . "'>$counter</a></li>";
                        }
                    }
                    echo "<li class='page-item'><a class='page-link'>...</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='" . $url . "page=" . $second_last . "'>$second_last</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='" . $url . "page=" . $allPages . "'>$allPages</a></li>";
                } elseif ($page > 4 && $page < $allPages - 4) {
                    echo "<li class='page-item'><a class='page-link' href='" . $url . "page=1'>1</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='" . $url . "page=2'>2</a></li>";
                    echo "<li class='page-item'><a class='page-link'>...</a></li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page) {
                            echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                        } else {
                            echo "<li  class='page-item' ><a class='page-link' href='" . $url . "page=" . $counter . "'>$counter</a></li>";
                        }
                    }
                    echo "<li  class='page-item'><a class='page-link'>...</a></li>";
                    echo "<li  class='page-item'><a class='page-link' href='" . $url . "page=" . $second_last . "'>$second_last</a></li>";
                    echo "<li  class='page-item'><a class='page-link' href='" . $url . "page=" . $allPages . "'>$allPages</a></li>";
                } else {
                    echo "<li  class='page-item'><a class='page-link' href='" . $url . "page=1'>1</a></li>";
                    echo "<li  class='page-item'><a class='page-link' href='" . $url . "page=2'>2</a></li>";
                    echo "<li  class='page-item'><a class='page-link'>...</a></li>";

                    for ($counter = $allPages - 6; $counter <= $allPages; $counter++) {
                        if ($counter == $page) {
                            echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                        } else {
                            echo "<li class='page-item'><a class ='page-link' href='" . $url . "page=" . $counter . "'>$counter</a></li>";
                        }
                    }
                }
            }
            if ($page >= $allPages) {
                echo '<li class="page-item disabled"><a class="page-link" href="" . $url . "page=' .    $allPages . '">Last</a></li>';
            }
            if ($page < $allPages) {
                echo '<li class="page-item"><a class="page-link" href="' . $url . 'page=' . $next_page . '" aria-label="Next" > <span aria-hidden="true">&raquo;</span></a></li>';
                echo '<li class="page-item"><a class="page-link" href="' . $url . 'page=' . $allPages . '">Last</a></li>';
            }
        }
    }


    public function get_pagination_links_All($current_page, $total_pages, $url)
    {
        $links = '<ul class="pagination">';
        if ($current_page > 1) {
            $links .= '<li class="page-item">
         <a class="page-link" href="' . $url . 'page=' . ($current_page - 1) . '" aria-label="Previous">
       <span aria-hidden="true">&laquo;</span>
     </a></li>';
        }
        if ($total_pages >= 1 && $current_page <= $total_pages) {
            if ($current_page == 1) {

                $links .= '<li class="page-item active"><a class="page-link" href="' . $url . 'page=1">1</a></li>';
            } else {

                $links .= '<li class="page-item"><a class="page-link" href="' . $url . 'page=1">1</a></li>';
            }
            $i = max(2, $current_page - 5);

            if ($i > 2)
                $links .= "   ";
            for (; $i < min($current_page + 6, $total_pages); $i++) {

                if ($i == $current_page) {

                    $links .= '<li class="page-item active"><a class="page-link" href="' . $url . 'page=' . $i . '">' . $i . '</a></li>';
                } else {

                    $links .= '<li class="page-item"><a class="page-link" href="' . $url . 'page=' . $i . '">' . $i . '</a></li>';
                }
            }
            if ($total_pages > 1) {
                if ($current_page != $total_pages) {

                    $links .= "   ";
                    $links .= '<li class="page-item" date="1"><a class="page-link" href="' . $url . 'page=' . $total_pages . '">' . $total_pages . '</a></li>';
                } else {

                    $links .= "   ";
                    $links .= '<li class="page-item active" date="2"><a class="page-link" href="' . $url . 'page=' . $total_pages . '">' . $total_pages . '</a></li>';
                }
            }
        }
        if ($total_pages > $current_page) {
            $links .= '<li class="page-item">
      <a class="page-link" href="' . $url . 'page=' . ($current_page + 1) . '" aria-label="Next">
      <span aria-hidden="true">&raquo;</span></a></li>';
        }
        $links .= '</ul>';
        return $links;
    }

    public function filtering($group_name, $salary, $offset, $limit)
    {


        $sql = "CALL dynamicFilter(:group_name,:salary);";

        $st = $this->conn->prepare($sql);

        $st = $this->conn->prepare($sql . ' ORDER BY id DESC LIMIT :off, :lim');
        // $st = $this->conn->prepare('SELECT * FROM users WHERE group_name = :group_name ORDER BY id DESC LIMIT :off, :lim');
        $st->bindValue(':off', $offset, PDO::PARAM_INT);
        $st->bindValue(':lim', $limit, PDO::PARAM_INT);
        $st->bindParam(':group_name', $group_name);
        $st->bindParam(':salary', $salary);
        // $st->bindValue(':group_name', $group_name, PDO::PARAM_STR);
        // $st->bindValue(':salary', $salary, PDO::PARAM_STR);
        $st->execute();
        $res =  $st->fetchObject();
        unset($st);


        $query = $res->sqlquery;
        // echo $query;
        // exit;
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo $query;
        return $res;

        // exit;

        // return ["result" => $res, "count" => count($res)];

        // dynamicFilter()

    }
}