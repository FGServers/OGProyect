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
            <th colspan="2"><img src="{dpath}elements/1.gif"></th>
            <th colspan="8"><p style="text-align:left;font-size:14px;">{tut_title_tusk_1}</p> <p style="text-align:left;font-weight:normal;">{tut_tusk_description_mission_1}</p></th>
        </tr>
        <tr>
            <th colspan="10">
                <h3 style="text-align:left;">{tut_tusk}</h3>
                <ul style="text-align:left;">
                    <li>
                        <span>{tut_tusk_required_mission_1_metal} {lvl_required_metall}</span>
                        <span><img src="{dpath}img/{metal_mine_4}.gif" height="11" width="13"></span>
                    </li>
                    <li>
                        <span>{tut_tusk_required_mission_1_crystal} {lvl_required_cristal}</span>
                        <span><img src="{dpath}img/{cristal_mine_2}.gif" height="11" width="13"></span>
                    </li>
                    <li>
                        <span>{tut_tusk_required_mission_1_solar} {lvl_required_solar}</span>
                        <span><img src="{dpath}img/{solar_plant_4}.gif" height="11" width="13"></span>
                    </li>
                </ul>
                <div class="Stil2">{tut_tusk_reward_mission_1}</div>
                <br />
                <span class="boton_test"><input type="button" onclick="toggleFormVisibility();" id="sub" value="{tut_btn_solution_hints_tutorial}" style="width:150px;height:30px;"></span>
                <span style="text-align: right">{button}</span>
                <br>
                <br>
                <div style="top:50px;text-align: left;background:#13181D;border:1px solid #030303;color:#848484;display:none;font-size:10px;padding:20px;width:auto;" id="tutorial_solution">
                    <ul class="solution">
                        <li>Haz clic en "Recursos" en el menú de la izquierda</li>
                        <li>Selecciona la planta de energía solar</li>
                        <li>Cuando haces clic en el link "Construir" o "Ampliar", empieza la ampliación de la planta de energía solar</li>
                        <li>Los recursos necesarios para la mejora serán descontados de tu crédito en la pantalla de recursos restantes.</li>
                        <li>Tan pronto como tu primera planta de energía solar haya sido construida, deberías construir una mina de metal</li>
                        <li>Si encargas la construcción de un edificio por error, puedes cancelar el proceso haciendo clic en el link "Cancelar" o "Eliminar". Los recursos invertidos te serán reembolsados completamente.</li>
                        <li>Para encontrar más información detallada sobre un edificio, haz clic sobre su nombre o en la imagen.</li>
                        <li>Generalmente, la secuencia de construcción preferida de los jugadores es: Solar 1, Metal 1, Metal 2, Solar 2, Metal 3, Metal 4, Solar 3, Cristal 1, Cristal 2</li>
                    </ul>
                </div>
                {messages}
            </th>
        </tr>
    </table>
</div>