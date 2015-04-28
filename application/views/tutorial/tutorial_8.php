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
            <th colspan="2"><img src="{dpath}elements/124.gif"></th>
            <th colspan="8"><p style="text-align:left;font-size:14px;">{tut_title_tusk_8}</p> <p style="text-align:left;font-weight:normal;">{tut_tusk_description_mission_8}</p></th>
        </tr>
        <tr>
            <th colspan="10">
                <h3 style="text-align:left;">{tut_tusk}</h3>
                <ul style="text-align:left;">
                    <li>
                        <span>{tut_tusk_required_mission_8_exped}</span>
                        <span><img src="{dpath}img/{expedition}.gif" height="11" width="13"></span>
                    </li>
                </ul>
                <div class="Stil2">{tut_tusk_reward_mission_8}</div>
                <br />
                <span class="boton_test"><input type="button" onclick="toggleFormVisibility();" id="sub" value="{tut_btn_solution_hints_tutorial}" style="width:150px;height:30px;"></span>
                <span style="text-align: right">{button}</span>
                <br>
                <br>
                <div style="top:50px;text-align: left;background:#13181D;border:1px solid #030303;color:#848484;display:none;font-size:10px;padding:20px;width:506px;" id="tutorial_solution">
                    <ul class="solution">
                            <li>Investiga la tecnologia de expedicion en el menú de investigación en el nivel 1</li>
                            <li>Vuela hacia un sistema a la posición {exp_pln} o empieza una expedición en la visión de la galaxia con el link de "Espacio exterior".</li>
                            <li> El resultado de una expedición es siempre incierta, por lo tanto, no arriesgues tu flota entera de inmediato.</li>
                    </ul>
                </div>
            </th>
        </tr>
    </table>
</div>