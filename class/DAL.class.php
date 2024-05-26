<?php

class DAL
{
    public $serverName = "localhost";
    public $userName = "root";
    public $password = "";
    public $dbName = "ecommerce";

    public function getData($sql)
    {
        $conn = new mysqli($this->serverName, $this->userName, $this->password, $this->dbName);
        if ($conn->connect_error) {
            throw new Exception($conn->connect_error);
        } else {
            $result = $conn->query($sql);
            if (!$result) {
                throw new Exception($conn->error);
            } else {
                $result = $conn->query($sql);
                $results = $result->fetch_all(MYSQLI_ASSOC);
                return $results;
            }
        }
    }
    public function getNumRows($sql)
    {
        $conn = new mysqli($this->serverName, $this->userName, $this->password, $this->dbName);

        if ($conn->connect_error) {
            throw new Exception($conn->connect_error);
        } else {
            $result = mysqli_query($conn, $sql);


            if (!$result) {
                throw new Exception($conn->error);
            } else {
                $numRows = $result->num_rows;


                return $numRows;
            }
        }
    }


    public function execute($sql)
    {
        $conn = new mysqli($this->serverName, $this->userName, $this->password, $this->dbName);
        if ($conn->connect_error) {
            throw new Exception($conn->connect_error);
        } else {
            $result = $conn->query($sql);
            if (!$result) {
                throw new Exception($conn->error);
                exit;
            } else {
                return $conn->insert_id;
            }
        }
    }
    public function moveMultipleFiles($image, $i, $dir)
    {
        $target_dir = $dir;
        $target_file = $target_dir . basename($image["name"][$i]);
        $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $img_name = str_replace("." . $extension, "", basename($image["name"][$i]));
        $count = 0;
        $image_name = $image["name"][$i];
        while (file_exists($target_file)) {
            $new_image = $img_name . "-" . $count . "." . $extension; //p1-0.png
            $image_name = $new_image;
            $target_file = $target_dir . $new_image; //uploads/p1-0.png
            $count++;
        }
        $res = move_uploaded_file($image["tmp_name"][$i], $target_file);
        return $image_name;
    }
    public function moveSingleFiles($image,  $dir)
    {
        $target_dir = $dir;
        $target_file = $target_dir . basename($image["name"]);
        $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $img_name = str_replace("." . $extension, "", basename($image["name"]));
        $count = 0;
        $image_name = $image["name"];
        while (file_exists($target_file)) {
            $new_image = $img_name . "-" . $count . "." . $extension;
            $image_name = $new_image;
            $target_file = $target_dir . $new_image;
            $count++;
        }
        $res = move_uploaded_file($image["tmp_name"], $target_file);
        return $image_name;
    }
    public function ConnectionDatabase()
    {
        return new mysqli($this->serverName, $this->userName, $this->password, $this->dbName);
    }



    public function data($sql, $params = array())
    {
        $conn = $this->ConnectionDatabase();

        if (!empty($params)) {
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                throw new Exception($conn->error);
            }

            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);

            $result = $stmt->execute();

            if ($result === false) {
                throw new Exception($stmt->error);
            }

            $resultSet = $stmt->get_result();
            $results = $resultSet->fetch_all(MYSQLI_ASSOC);

            $stmt->close();
        } else {
            $result = $conn->query($sql);

            if ($result === false) {
                throw new Exception($conn->error);
            }

            $results = $result->fetch_all(MYSQLI_ASSOC);
        }

        $conn->close();

        return $results;
    }


    public function validatePhoneNumber($phone)
    {
        $phone = preg_replace('/[\/ ]/', '', $phone);
        $pattern = '/^(?:\+?\d{1,3})?[ -]?\(?\d{3}\)?[ -]?[0-9]{3}[ -]?[0-9]{4}$/';
        $pattern2 = '/^\+?[1-9][0-9]{7,14}$/';
        if (preg_match($pattern, $phone) || preg_match($pattern2, $phone)) {
            return $phone;
        } else {
            return false;
        }
    }
    public function have_script($value)
    {
        $patterns = array(
            '/<script>/i',
            '/<script src="">/i',
            '/<\/script>/i',
            '/<\?php/i',
            '/<\?/i',
            '/exec\(/i',
            '/system\(/i',
            '/passthru\(/i'
        );
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $value, $matches)) {
                return $matches[0];
            }
        }
        return false;
    }
    public function validate($method)
    {

        if ($method == "post") {

            foreach ($_POST as $k => $v) {
                if (gettype($_POST["$k"]) == "array") {
                    foreach ($_POST["$k"] as $k1 => $v1) {
                        $scriptType = $this->have_script($v1);
                        if ($scriptType) {
                            $_POST["$k"]["$k1"] = " ";
                            echo json_encode(array(
                                'status' => 'error',
                                'message' => "Invalid input. Detected $scriptType in the input."
                            ));
                            exit();
                        }
                    }
                } else {
                    $scriptType = $this->have_script($v);
                    if ($scriptType) {
                        $_POST["$k"] = " ";
                        echo json_encode(array(
                            'status' => 'error',
                            'message' => "Invalid input. Detected $scriptType in the input."
                        ));
                        exit();
                    }
                }
            }
        } else if ($method == "get") {
            foreach ($_GET as $k => $v) {
                if (gettype($_GET["$k"]) == "array") {
                    foreach ($_GET["$k"] as $k1 => $v1) {
                        $scriptType = $this->have_script($v1);
                        if ($scriptType) {
                            $_GET["$k"]["$k1"] = " ";
                            echo json_encode(array(
                                'status' => 'error',
                                'message' => "Invalid input. Detected $scriptType in the input."
                            ));
                            exit();
                        }
                    }
                } else {
                    $scriptType = $this->have_script($v);
                    if ($scriptType) {
                        $_GET["$k"] = " ";
                        echo json_encode(array(
                            'status' => 'error',
                            'message' => "Invalid input. Detected $scriptType in the input."
                        ));
                        exit();
                    }
                }
            }
        }
    }
    public function destroySession($user)
    {
        session_start();
        $sql = "SELECT * FROM `users` WHERE user_name='$user'";
        $result = $this->getData($sql);
        if ($result) {
            return true;
        } else return false;
    }
}
