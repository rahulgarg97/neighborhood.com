<?php include "header.php" ?>
</head>
<body>
<?php include "nav.php" ?>
<?php
          
          session_start();
          $cemail = $_SESSION['email'];
          // $sql = "select concat(ufname, ' ', ulname) as name from user join (select residents.uemail from residents where residents.uemail != ? and residents.neighborhood_id = (select neighborhood_id from residents where uemail = ?) and residents.block_id = (select block_id from residents where uemail = ?)) a
          // where a.uemail = user.uemail";
          
           $sql = "select concat(ufname, ' ', ulname) as name from user join (select residents.uemail from residents where residents.uemail != ? and residents.neighborhood_id = (select neighborhood_id from residents where uemail = ?)) a where a.uemail = user.uemail";
          // $sql = "select uemail from residents where uemail != ? and neighborhood_id = (select neighborhood_id from residents where uemail = ?)";
          $statement = $link->prepare($sql);
          $statement->bind_param('ss', $cemail, $cemail);
          $statement->execute();
          $result = $statement->get_result();
          //  $result = $link->query($sql);
          if ($result->num_rows > 0) {
          echo "<ul class='list-group'>";
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
              echo " <li class='list-group-item'>".$row["name"]."</li>";
              }
            $result->close();
            echo "</ul>";
          } else {
            echo "No Neighborhood Members Available";
          }
          $statement->close();
?>
<!-- <ul class="list-group">
  <li class="list-group-item" aria-disabled="true">Cras justo odio</li>
  <li class="list-group-item">Dapibus ac facilisis in</li>
  <li class="list-group-item">Morbi leo risus</li>
  <li class="list-group-item">Porta ac consectetur ac</li>
  <li class="list-group-item">Vestibulum at eros</li>
</ul> -->
</body>
</html>