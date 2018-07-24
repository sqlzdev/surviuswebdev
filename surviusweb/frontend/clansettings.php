<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Survius Control Panel</title>

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">


    <link rel="stylesheet" href="icon/style.css">
    <link rel="stylesheet" href="css/cpstyle.css">
    <link rel="stylesheet" href="css/clanstyle.css">


            <div class="header">
                <div class="logo-title">
                    <img src="image/survius.png" alt="">
                    <h2>Survius</h2>
                </div>
            </div>
            <ul>
      <li><a class="active" href="main.php">Home</a></li>
      <li><a href="clan.php">Clan Managment</a></li>
      <li><a href="settings.php">User settings</a></li>
      <li><a href="#about">About</a></li>
      <li style="float:right"><a class="active2" href="logout.php">Logout</a></li>
    </ul>

</head>
<body>
  <div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    This site is in development yet, report every error.
  </div>
  <div style="text-align:center;color:#fff;margin:2%">
    <p>Clan Managment</p>
  </div>
  <center>
    <form action="addnewmember.php" method="POST">
        <br/><br/><br/>
        <input type="text" required name="user" class="field" placeholder="Player Name" value="" /><br/><br/>
        <input type="submit" class="field" value="Add New Member +" />
      </form>
    </center>
    <center>
      <div style="width:50%;margin:100px">
      <table>
          <thread>
            <tr>
            <th class="table">Clan List</th>
            </tr>
          </thread>
          <tbody class="table">
                <td>Name</td>
                <td>Date</td>
                <td>Delete</td>
          </tbody>
        </table>
      </center>
    </div>

</body>
</html>
