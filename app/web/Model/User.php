<?php

namespace app\web\Model;

use app\system\database\Database;

class User extends Database
{
    public function save()
    {
        $conn = $this->startDB();
        // prepare and bind
        $stmt = $conn->prepare("INSERT INTO test (test) VALUES (?)");
        $test = "<?php echo 'ok'; ?>";
        $stmt->bind_param("s", $test);
        $stmt->execute();
        return 'ok';
    }
}