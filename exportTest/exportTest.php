<?php    

require '../dao/dao.class.php';
require '../dao/presenceDao.class.php';

        $dao = new PresenceDao;
        $dao->getConnexion();

            $allData =  "";
            $sql = $conn->query("SELECT `name`, `participate.slotDateStart`, `Lastname`, `Firstname`, `PhoneNumber`, `presence` FROM activity 
            INNER JOIN participate ON activity.id_activity = participate.id_activity 
            INNER JOIN users ON participate.id_user = users.id_user 
            INNER JOIN host ON users.id_user = host.id_user");

        while($data = $sql->fetch_assoc()) { 
        $allData .= $data['name'] . ',' . $data['slotDateStart'] . "," . $data['Lastname'] . "," . $data['Firstname'] . "," . $data['PhoneNumber']. "," . $data['presence'] . "\n";
        }

        $response = "data:text/csv;charset=utf-8,NAME,SLOTDATE,LASTNAME,FIRSTNAME,PHONE,PRESENCE\n";
        $response .= $allData;

        echo '<a href="'.$response.'" download="presence.csv">Download</a>';

?>