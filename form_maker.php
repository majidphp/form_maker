<?php
class form
{
	public function open_form($method = 'POST', $action = null, $class = null): string
	{
		$return = '<form method="'.$method.'" action="'.$action.'" class="'.$class.'">'."\n";
		return $return;
	}

	public function close_form()
	{
		$return = '</form>';
		return $return;
	}

	public function input($type, $name = false, $value = false, $id = false, $extra = false): string
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

	public function text_area($name = false, $value = false, $id = false, $extra = false): string
	{
		$return = '<textarea name="'.$name.'"';
		if ($extra) {
			foreach ($extra as $key => $val) { $return .= ' '.$key.'="'.$val.'"'; }
		}
		if ($id) $return .= 'id="'.$id.'"';
		$return .= '>'.$value.'</textarea>'."\n";
		return $return;
	}

	public function drop_down($name = false, $options = [], $selected = [], $multiple = false, $extra = false): string
	{
		$return = '<select name="'.$name.'"'."\n";
		if ($multiple) $return .= ' multiple="multiple"';
		if ($extra) {
			foreach($extra as $key => $val) { $return .= ' '.$key.'="'.$val.'"'; }
		}
		$return .= '>';
		foreach ($options as $key => $val) {
			if (is_array($val)) {
				$return .= '<optgroup label="'.$key.'">';
				foreach ($val as $k => $v) {
					$return .= '<option value="'.$k.'"';
					if (in_array($k, $selected)) $return .= 'selected';
					$return .= '>'.$v.'</option>'."\n";
				}
				$return .= '</optgroup>';
			} else {
				$return .= '<option value="'.$key.'"';
				if (in_array($key, $selected)) $return .= 'selected';
				$return .= '>'.$val.'</option>'."\n";
			}
		}
		$return .= '</select>'."\n";
		return $return;
	}

	public function button($type, $name = false, $content = '', $id = false, $extra = false): string
	{
		if (!in_array($type, ['button', 'reset', 'submit'])) $type = 'button';
		$return = '<button type="'.$type.'"';
		if ($id) $return .= 'id="'.$id.'"';
		if ($extra) {
			foreach($extra as $key => $val) { $return .= ' '.$key.'="'.$val.'"'; }
		}
		$return .= '>';
		$return .= $content.'</button>';
		return $return;
	}

	public function checkbox($name = false, $options = [], $extra = false): string
	{
		$return = '';
		if (count($options) > 0) {
			$name .= '[]';
		}
		foreach ($options as $checkbox) {
			$return .= '<input type="checkbox" name="'.$name.'" value="'.$checkbox['value'].'"';
			if ($checkbox['id']) {
				$return .= 'id="'.$checkbox['id'].'"';
			}
			if ($extra) {
				foreach($extra as $k => $v) { $return .= ' '.$k.'="'.$v.'"'; }
			}
			if ($checkbox['cehcked']) {
				$return .= ' checked';
			}
			$return .= ' /><lable ';
			if ($checkbox['id']) {
				$return .= 'for="'.$checkbox['id'].'"';
			}
			$return .= '>'.$checkbox['title'].'</lable>'."\n";
		}
		return $return;
	}

	public function radio($name = false, $options = [], $extra = false): string
	{
		$return = '';
		foreach ($options as $radio) {
			$return .= '<input type="radio" name="'.$name.'" value="'.$radio['value'].'"';
			if ($radio['id']) {
				$return .= 'id="'.$radio['id'].'"';
			}
			if ($extra) {
				foreach($extra as $k => $v) { $return .= ' '.$k.'="'.$v.'"'; }
			}
			if ($radio['cehcked']) {
				$return .= ' checked';
			}
			$return .= ' /><lable ';
			if ($radio['id']) {
				$return .= 'for="'.$radio['id'].'"';
			}
			$return .= '>'.$radio['title'].'</lable>'."\n";
		}
		return $return;
	}

	public function range($min = false, $max = '', $step = false, $value = false, $show = false, $id = false, $extra = false): string
	{
		$return = '<input type="range" min="'.$min.'" max="'.$max.'" value="'.$value.'" step="'.$step.'"';
		if ($extra) {
			foreach($extra as $key => $val) { $return .= ' '.$key.'="'.$val.'"'; }
		}
		if ($id) {
			$return .= 'id="'.$id.'"';
			$lableId = "range_$id";
		} else {
			$labledId = 'range_'.rand();
		}
		if ($show) {
			$return .= " oninput=\"document.getElementById('$labledId').innerHTML = this.value\" />
			<lable id=\"$labledId\">".$value.'</lable>';
		} else {
			$return .= ' />';
		}
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
echo $form->drop_down('selectboxname', $options, ['med', 'small_2'], true, ['id'=>'size']);
echo $form->text_area('textarea', 'text...', extra:['placeholder'=>'Your address']);
echo $form->input('submit', 'btn', 'Send');
echo $form->input('reset', 'res', 'Restart', extra:['onclick'=>"alert('form will be clean')"]);
echo "<br/>";
$options = [
	['value'=>'m1', 'title'=>'M1', 'cehcked'=>true],
	['value'=>'m2', 'title'=>'M2', 'id'=>'id_m2'],
];
echo $form->checkbox('checkboxname', $options);
echo "<br/>";
$options = [
	['value'=>'r1', 'title'=>'R1', 'checked'=>true],
	['value'=>'m2', 'title'=>'R2', 'id'=>'id_m2'],
];
echo $form->radio('radioname', $options);
echo $form->input('file', 'upload_file');
echo "<br/>";
echo $form->range(10, 20, 1, 15, show:true);
echo $form->button('reset', 'testbtn', content:'Test button', id:'test_id');
echo $form->close_form();
