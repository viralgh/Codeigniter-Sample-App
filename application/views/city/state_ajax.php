<?php

$str = '';

if($states)
{
	foreach ($states as $state)
	{
		$selected_this = '';
		if($selected == $state->id)
		{
			$selected_this = ' selected';
		}
		$str .= "<option value='{$state->id}'{$selected_this}>{$state->name}</option>";
	}
}
else
{
	$str = "<option value=''>--- no states for country ---</option>";
}

echo $str;

