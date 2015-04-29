<script type='text/javascript'>
/*javascript powerby JONAMIX from OGP
 * This code its private All rights reserved.
 */
function toggleFormVisibility()
{
  var element = document.getElementById('tutorial_solution'); 
  var link_element = document.getElementById('sub');

  var vis = element.style;
  
  if(vis.display=='' || vis.display=='none') {
      vis.display = 'block';
      link_element.style.display='none';
      link_element.style.display='';
  } else {
      vis.display = 'none';
      link_element.style.display='block';
      link_element.style.display='';
  }

}
</script>
<div id="content">
    <table width="560">
        <tr>
            <td class="c" colspan="10">{tut_title}</td>
        </tr>
        <tr>
            <th colspan="1"><a href="game.php?page=tutorial&mision=1">1</a><img src="{dpath}img/{tut_1}.gif" /></th>
            <th colspan="1"><a href="game.php?page=tutorial&mision=2">2</a><img src="{dpath}img/{tut_2}.gif" /></th>
            <th colspan="1"><a href="game.php?page=tutorial&mision=3">3</a><img src="{dpath}img/{tut_3}.gif" /></th>
            <th colspan="1"><a href="game.php?page=tutorial&mision=4">4</a><img src="{dpath}img/{tut_4}.gif" /></th>
            <th colspan="1"><a href="game.php?page=tutorial&mision=5">5</a><img src="{dpath}img/{tut_5}.gif" /></th>
            <th colspan="1"><a href="game.php?page=tutorial&mision=6">6</a><img src="{dpath}img/{tut_6}.gif" /></th>
            <th colspan="1"><a href="game.php?page=tutorial&mision=7">7</a><img src="{dpath}img/{tut_7}.gif" /></th>
            <th colspan="1"><a href="game.php?page=tutorial&mision=8">8</a><img src="{dpath}img/{tut_8}.gif" /></th>
            <th colspan="1"><a href="game.php?page=tutorial&mision=9">9</a><img src="{dpath}img/{tut_9}.gif" /></th>
            <th colspan="1"><a href="game.php?page=tutorial&mision=10">10</a><img src="{dpath}img/{tut_10}.gif" /></th>
        </tr>
        <tr>
            <th colspan="2"><img src="{dpath}elements/123.gif"></th>
            <th colspan="8"><p style="text-align:left;font-size:14px;">{tut_title_tusk_5}</p> <p style="text-align:left;font-weight:normal;">{tut_tusk_description_mission_5}</p></th>
        </tr>
        <tr>
            <th colspan="10">
                <h3 style="text-align:left;">{tut_tusk}</h3>
                <ul style="text-align:left;">
                    <li>
                        <span>{tut_tusk_required_mission_5_rename}</span>
                        <span><img src="{dpath}img/{planet_rename}.gif" height="11" width="13"></span>
                    </li>
                    <li>
                        <span>{tut_tusk_required_mission_5_buddy}</span>
                        <span><img src="{dpath}img/{buddy_count}.gif" height="11" width="13"></span>
                    </li>
                    <li>
                        <span>{tut_tusk_required_mission_5_ally}</span>
                        <span><img src="{dpath}img/{alliance_count}.gif" height="11" width="13"></span>
                    </li>
                </ul>
                <div class="Stil2">{tut_tusk_reward_mission_5}</div>
                <br />
                <span class="boton_test"><input type="button" onclick="toggleFormVisibility();" id="sub" value="{tut_btn_solution_hints_tutorial}" style="width:150px;height:30px;"></span>
                <span style="text-align: right">{button}</span>
                <br>
                <br>
                <div style="top:50px;text-align: left;background:#13181D;border:1px solid #030303;color:#848484;display:none;font-size:10px;padding:20px;width:506px;" id="tutorial_solution">
                    <ul class="solution">
                        <li>En la vision general del men� puedes cambiar el nombre de tus planetas.</li>
                        <li>El enlace hacia el foro lo puedes encontrar en el menu igualmente, te conviene revisarlo de vez en cuando. Haz clic en el enlace para visitar el foro.</li>
                        <li>Si alguno de tus amigos tambi�n se ha registrado en OGProyect, lo podr�s encontrar utilizando la opci�n de b�squeda en el encabezado e introduciendo all� su nombre de usuario. Finalmente, haz clic en el s�mbolo de amigo para enviar una solicitud. Si todav�a no conoces a nadie en tu universo, puedes invitar a alg�n vecino. Cada visita a los sistemas solares ajenos en la visi�n de la galaxia te cuesta 10 unidades de deuterio.</li>
                        <li>Para pertenecer a una alianza, puedes unirte a una alianza ya creada o fundar tu propia alianza. Esto lo puedes hacer en la opcion "Alianza" del men�. Si deseas aplicar una solicitud para otra alianza, entonces elige la alianza deseada y luego haz clic en el s�mbolo de solicitud.</li>
                    </ul>
                </div>
                {messages}
            </th>
        </tr>
    </table>
</div>