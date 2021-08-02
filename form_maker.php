<?php
class form
{
	public function open_form($method='POST', $action=null, $class=null)
	{
		$return = '<form method="'.$method.'" action="'.$action.'" class="'.$class.'">'."\n";
		return $return;
	}

	public function close_form()
	{
		$return = '</form>';
		return $return;
	}

	public function input($type, $name=false, $value=false, $id=false, $extra=false)
	{
		$return = '<input type="'.$type.'" ';
		if ($extra) {
			foreach($extra as $key => $val) { $return .= ' '.$key.'="'.$val.'"'; }
		}
		if ($id) $return .= 'id="'.$id.'"';
		if ($name) $return .= 'name="'.$name.'"';
		if ($value) $return .= 'value="'.$value.'"';
		$return .= ' />'."\n";
		return $return;
	}

	public function text_area($name=false, $value=false, $id=false, $extra=false)
	{
		$return = '<textarea name="'.$name.'"';
		if ($extra) {
			foreach ($extra as $key => $val) { $return .= ' '.$key.'="'.$val.'"'; }
		}
		$return .= '>'.$value.'</textarea>'."\n";
		return $return;
	}

	public function drop_down($options, $selected=false, $extra=false)
	{
		$return = '<select'."\n";
		if ($extra) {
			foreach($extra as $key => $val) { $return .= ' '.$key.'="'.$val.'"'; }
		}
		$return .= '>';
		foreach ($options as $key => $val) {
			if (is_array($val)) {
				$return .= '<optgroup label="'.$key.'">';
				foreach ($val as $k => $v) {
					$return .= '<option value="'.$k.'"';
					if ($k === $selected) $return .= 'selected';
					$return .= '>'.$v.'</option>'."\n";
				}
				$return .= '</optgroup>';
			} else {
				$return .= '<option value="'.$key.'"';
				if ($key === $selected) $return .= 'selected';
				$return .= '>'.$val.'</option>'."\n";
			}
		}
		$return .= '</select>'."\n";
		return $return;
	}

}

$form = new form;
echo $form->open_form('GET', 'test.php', 'green');
echo $form->input('text', value:'Majid', extra:['onblur'=>"alert('Hi event')", 'placeholder'=>'Please enter your name']);
echo $form->input('password', 'password[]', extra:['placeholder'=>'Pawwsord']);
echo $form->input('password', 'password[]', extra:['placeholder'=>'Pawwsord']);
$options = [
	'small'  => ['small_1'=>1,'small_2'=>2,'small_3'=>3],
    'med'    => 'Medium Shirt',
    'large'  => 'Large Shirt',
    'xlarge' => 'Extra Large Shirt',
];
echo $form->drop_down($options, 'med', ['id'=>'size']);
echo $form->text_area('textarea', 'text...', extra:['placeholder'=>'Your address']);
echo $form->input('submit', 'btn', 'Send');
echo $form->input('reset', 'res', 'Restart', extra:['onclick'=>"alert('form will be clean')"]);
echo $form->close_form();
