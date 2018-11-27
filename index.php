<?php

$cdc = $_POST["cdc"];
$cdcpwd = $_POST["cdcPwd"];
$email = $_POST["email"];
$outpwd = $_POST["outPwd"];

$op = $_POST["op"];


if ($_SERVER["REQUEST_METHOD"] == "POST") //form sent
{

  if((!isset($cdc) && !isset($cdcpwd)) || (!isset($email) && !isset($outpwd)))//se dati cdc non impostati
  {
        echo "DATI NON INSERITI: Compilare uno dei due form e riprovare!";
  }else {
    if(isset($op))
    {
      header(./reponse.php);
    }
  }


 ?>

<html>
   <head>
      <style>
         html { font-family: sans-serif; background-color: #4169E1;}
         #negozi {
         padding-top: 20vh;
         padding-left: 35vw;
         }

         #esterni {
           padding-top: 10vh;
           padding-left: 35vw;
         }

         #menu {

           text-align: center;
           /*border: 1px solid;*/
           padding: 1px 1px 1px 1px;
         }

         fieldset {
           display: inline-block;
         }
      </style>
   </head>
   <body>
      <div id="negozi">
         <fieldset>
            <!---ACCESSO NEGOZI---------------------------------------------------------------->
            <legend>ACCESSO NEGOZI</legend>
            <form class="datainput" action="<?php echo htmlspecialchars( . 'response.php' .  )?>" method="post">
               <table>
                  <tr>
                     <td>
                        <label>Centro di costo</label>
                     </td>
                     <td>
                        <select name="cdc">
                          <option selected></option>
                           <option>CDC 434</option>
                           <option>CDC 402</option>
                           <option>CDC 401</option>
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <label>Password: </label>
                     </td>
                     <td>
                        <input type="text" name="cdcPwd">
                     </td>
                  </tr>
               </table>
         </fieldset>
      </div>

      <div id="esterni">
      <fieldset>
         <legend>ACCESSO ESTERNI</legend>
         <!---ACCESSO ESTERNI---------------------------------------------------------------->
         <table>
            <tr>
               <td>
                  <label>Email </label>
               </td>
               <td>
                  <input type="email" name="email">
               </td>
            </tr>
            <tr>
               <td>
                  <label>Password </label>
               </td>
               <td>
                  <input type="password" name="outPwd">
               </td>
            </tr>
         </table>
      </fieldset>
    </div>
      </form>



      <br><br>


<div id="menu">
      <select name="op">
         <option value="incassiore">INCASSI E ORE (settimanali)</option>
         <option value="differenze">MOD. 140</option>
         <option value="rifiuti">MOD. 54</option>
         <option value="manutenzioni">MOD. 23</option>
      </select><br><br>
    <input type="button" value="INVIA">
    </div>


      </body>
      </html>
