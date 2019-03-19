<?php
if($_GET['errmsg']=="1")
{ ?>
    <script>
        alert('Nessuna operazione selezionata!');
    </script>

<?php } ?>

<html>
   <head>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js"></script>
      <style>
         html { font-family: sans-serif; background-color: #4169E1;}
         #negozi {
         padding-top: 20vh;
         padding-left: 35vw;
         
         }

        [type=submit]{ margin: auto;}

         #esterni {
           padding-top: 10vh;
           padding-left: 35vw;
         }

         
         fieldset {
           display: inline-block;
         }
      </style>
   </head>
   <body>
         
      <div id="negozi">
         <form action="response.php" method="post">
               <fieldset>
               <!---ACCESSO NEGOZI---------------------------------------------------------------->
                  <legend>ACCESSO NEGOZI</legend>         
               <table>
                  <tr>
                     <td>
                        <label>Centro di costo: </label>
                     </td>
                     <td>
                       <input type="text" name="cdc" maxlength="6" placeholder="Es.cdc434" required>

                     </td>
                  </tr>
                  <tr>
                     <td>
                        <label>Password: </label>
                     </td>
                     <td>
                        <input type="password" name="cdcPwd" required>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <label>Modello: </label>
                     </td>
                     <td>
                           <select name="op" required>
                                 <option selected></option>
                                  <option value="incassiore">INCASSI E ORE (settimanali)</option>
                                  <option value="differenze">MOD. 140</option>
                                  <option value="rifiuti">MOD. 54</option>
                                  <option value="manutenzioni">MOD. 23</option>
                               </select>
                     </td>

                  </tr>
                  <tr>
                     <td></td>
                     <td>
                        <input type="submit" value="Accesso negozio"><!--bottone accesso dipendenti-->
                     </td>
                  </tr>
               </table>
            </fieldset>
             </form>
         
      </div>

      <div id="esterni">
         <form id="outinput" action="outresponse.php" method="post">
               <fieldset>
                     <legend>ACCESSO ESTERNI</legend>
                     <!---ACCESSO ESTERNI---------------------------------------------------------------->            
         <table>
            <tr>
               <td>
                  <label>Email: </label>
               </td>
               <td>
                  <input type="email" name="email" required>
               </td>
            </tr>
            <tr>
               <td>
                  <label>Password: </label>
               </td>
               <td>
                  <input type="password" name="outPwd" required>
               </td>
            </tr>
               <tr>
                  <td>
                     <!--IL MENU DI SCELTA DEL MODELLO COMPARE AD ACCESSO EFFETTUATO-->
                  </td>
                  <td>
                        <input type="submit" value="Accesso esterni"><!--bottone accesso esterni-->
                  </td>
               </tr>
         </table>
      </fieldset>
         </form>
      
    </div>




      <br><br>


    
    </div>



      </body>
      </html>
