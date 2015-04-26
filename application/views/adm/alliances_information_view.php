<h2>{al_alliance_information}</h2>
{alert_info}
<form name="save_info" method="post" action="">
<input type="hidden" name="alliance_name_orig" value="{alliance_name}">
<input type="hidden" name="ally_tag_orig" value="{ally_tag}">
<input type="hidden" name="ally_founder_orig" value="{ally_founder}">
<table width="100%" class="table table-bordered table-hover table-condensed">
	<tr>
		<th width="50%">{al_alliance_information_field}</th>
		<th width="50%">{al_alliance_information_value}</th>
	</tr>
	<tr>
		<td>{al_alliance_information_register_time}</td>
		<td>{ally_register_time}</td>
	</tr>
	<tr>
		<td>{al_alliance_information_name}</td>
		<td><input type="text" name="alliance_name" value="{alliance_name}"></td>
	</tr>
	<tr>
		<td>{al_alliance_information_tag}</td>
		<td><input type="text" name="ally_tag" value="{ally_tag}"></td>
	</tr>
	<tr>
		<td>{al_alliance_information_owner}</td>
		<td>
			<select name="ally_owner">
				{ally_owner}
			</select>
		</td>
	</tr>
	<tr>
		<td>{al_alliance_information_owner_range}</td>
		<td><input type="text" name="ally_owner_range" value="{ally_owner_range}"></td>
	</tr>
	<tr>
		<td>{al_alliance_information_web}</td>
		<td><input type="text" name="alliance_web" value="{alliance_web}"></td>
	</tr>
	<tr>
		<td>{al_alliance_information_image}</td>
		<td><input type="text" name="ally_image" value="{ally_image}"></td>
	</tr>
	<tr>
		<td>{al_alliance_information_description}</td>
		<td>
			<textarea name="ally_description" class="field span12" rows="10">{ally_description}</textarea>
		</td>
	</tr>
	<tr>
		<td>{al_alliance_information_text}</td>
		<td>
			<textarea name="ally_text" class="field span12" rows="10">{ally_text}</textarea>
		</td>
	</tr>
	<tr>
		<td>{al_alliance_information_request}</td>
		<td>
			<textarea name="ally_request" class="field span12" rows="10">{ally_request}</textarea>
		</td>
	</tr>
	<tr>
		<td>{al_alliance_information_request_notallow}</td>
		<td>
			<select name="ally_request_notallow">
				<option value="1" {sel1}>{al_allow_yes}</option>
				<option value="0" {sel0}>{al_allow_no}</option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<div align="center">
				<input type="submit" class="btn btn-primary" name="send_data" value="{al_send_data}">
			</div>
		</td>
	</tr>
</table>
</form>