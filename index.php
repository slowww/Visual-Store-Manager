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
           margin-left: 40vw;
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
            <form class="datainput" action="response.php" method="post">
               <table>
                  <tr>
                     <td>
                        <label>Centro di costo</label>
                     </td>
                     <td>
                        <select name="cdc">
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
                        <input type="text">
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
                  <input type="text" name="email">
               </td>
            </tr>
            <tr>
               <td>
                  <label>Password </label>
               </td>
               <td>
                  <input type="text" name="password">
               </td>
            </tr>
         </table>
      </fieldset>
    </div>
      </form>



      <br><br>


<div id="menu">
      <select name="op">
         <option>INCASSI E ORE (settimanali)</option>
         <option>MOD. 140</option>
         <option>MOD. 54</option>
         <option>MOD. 23</option>
      </select>
    </div>
      <br>
      </body>
      </html>
