<?php
/*
 * Make a table
 * Example
 * [ym-table class="bordertable" delimiter=";"]
 * Id;Product Name;Value
 * 1;Pencil;cheap
 * 2;Car;expensive
 * [/ym-table]
 */
add_shortcode('ym-table', function($atts, $content = '') {
    extract( shortcode_atts( array(
        'class' => '',
        'delimiter' => ';'
    ), $atts ) ); 
    
	$content = str_replace(array('<br />', '<br/>', '<br>'), array('', '', ''), $content);
	$content = str_replace('<p>', PHP_EOL, $content);
	$content = str_replace('</p>', '', $content);
	
	$content = str_replace('&nbsp;', '', $content);
	$char_codes = array('&#8216;', '&#8217;', '&#8220;', '&#8221;', '&#8242;', '&#8243;');
	$replacements = array("'", "'", '"', '"', "'", '"');
	$content = trim(str_replace($char_codes, $replacements, $content));
    
    $class = !empty($class) ? sprintf(' class="%s"', $class) : '';
    $content = explode(PHP_EOL, $content);

    $output = '';
    if(empty($content[0])) {
        return $output;
    }
    
    $thead = explode($delimiter, $content[0]);
    
    array_shift($content);
    
    $output .= sprintf('<table%1$s>%2$s', $class, PHP_EOL);
    
    $output .= sprintf('<thead><tr>%s', PHP_EOL);
    foreach($thead as $col) {  
        $output .= sprintf('<th>%s</th>%s', $col, PHP_EOL);
    }
    $output .= sprintf('</tr></thead>%s', PHP_EOL);
    
    $output .= '<tbody>';
    foreach($content as $row) {
        $output .= sprintf('<tr>%s', PHP_EOL);
        $cols = explode($delimiter, $row);
        if(!empty($row) && count($cols) == count($thead)) {
            foreach($cols as $col) {
                $output .= sprintf('<td>%s</td>%s', $col, PHP_EOL);
            }
        }
        $output .= sprintf('</tr>%s', PHP_EOL);
    }
    $output .= sprintf('</tbody>', PHP_EOL);
    
    $output .= sprintf('</table>', PHP_EOL);
    
    return $output;    
});
