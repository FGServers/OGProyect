<br />
<div id='content'>
    <form action="" method="post">
    <table width="550">
    <tr>
        <td class="c" colspan="6">{Production_of_resources_in_the_planet}</td>
    </tr>
    <tr>
        <th colspan="2"></th>
        <th>{Metal}</th>
        <th>{Crystal}</th>
        <th>{Deuterium}</th>
        <th>{Energy}</th>
    </tr>
    <tr>
        <th colspan="2">{rs_basic_income}</th>
        <td class="k">{metal_basic_income}</td>
        <td class="k">{crystal_basic_income}</td>
        <td class="k">{deuterium_basic_income}</td>
        <td class="k">{energy_basic_income}</td>
    </tr>
        {resource_row}
    <tr>
        <th colspan="2">{rs_storage_capacity}</th>
        <td class="k">{metal_max}</td>
        <td class="k">{crystal_max}</td>
        <td class="k">{deuterium_max}</td>
        <td class="k">-</td>
        <td class="k"><input name="action" value="{rs_calculate}" type="submit"></td>
    </tr>
    <tr>
        <th class="c" colspan="6" height="4"></th>
    </tr>
    <tr>
        <th colspan="2">{rs_sum}</th>
        <td class="k">{metal_total}</td>
        <td class="k">{crystal_total}</td>
        <td class="k">{deuterium_total}</td>
        <td class="k">{energy_total}</td>
    </tr>  
    <tr>
        <th colspan="2">{rs_daily}</th>
        <td class="k">{daily_metal}</td>
        <td class="k">{daily_crystal}</td>
        <td class="k">{daily_deuterium}</td>
        <td class="k">{energy_total}</td>
     </tr>
    <tr>
        <th colspan="2">{rs_weekly}</th>
        <td class="k">{weekly_metal}</td>
        <td class="k">{weekly_crystal}</td>
        <td class="k">{weekly_deuterium}</td>
        <td class="k">{energy_total}</td>
     </tr>    
  </table>
</form>
</div>