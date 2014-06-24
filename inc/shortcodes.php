<?php
/*
 * ym-table Shortcode
 * Usage Example (type :br: for a line break)
 * [ym-table class="bordertable" delimiter=";"]
 * Id;Product Name;Value
 * 1;Pencil;cheap:br:not available at the moment
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
        $content = str_replace(':br:', '<br>', $content);        
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
        $output .= sprintf('<th>%1$s</th>%2$s', $col, PHP_EOL);
    }
    $output .= sprintf('</tr></thead>%s', PHP_EOL);
    
    $output .= sprintf('<tbody>%s', PHP_EOL);
    foreach($content as $row) {
        $output .= sprintf('<tr>%s', PHP_EOL);
        $cols = explode($delimiter, $row);
        if(!empty($row) && count($cols) == count($thead)) {
            foreach($cols as $col) {
                $output .= sprintf('<td>%1$s</td>%2$s', $col, PHP_EOL);
            }
        }
        $output .= sprintf('</tr>%s', PHP_EOL);
    }
    $output .= sprintf('</tbody>%s', PHP_EOL);
    
    $output .= sprintf('</table>%s', PHP_EOL);
    
    return $output;    
});

/*
 * ym-tabs Shortcode
 * Usage Example
 * [ym-tabs]
 * [ym-tab title="First Tab"]Content for tab one goes here.[/ym-tab]
 * [ym-tab title="Second Tab"]Content for tab two goes here.[/ym-tab]
 * [ym-tab title="Third Tab"]Content for tab three goes here.[/ym-tab]
 * [/ym-tabs]
 */
add_shortcode('ym-tabs', function($atts, $content = '') {
    extract( shortcode_atts( array(
        'class' => ''
    ), $atts ) ); 
    
    $content = do_shortcode($content);
    
    $output = '';
    if(empty($content)) {
        return $output;
    }
    
    $output .= sprintf('<div class="jquery_tabs">%s', PHP_EOL);
    $output .= sprintf('%1$s%2$s', $content, PHP_EOL);
    $output .= sprintf('</div>%s', PHP_EOL);
    
    return $output;    
});

add_shortcode('ym-tab', function($atts, $content = '') {
    extract( shortcode_atts( array(
        'title' => ''
    ), $atts ) ); 

    $output = '';
    if(empty($title) || empty($content)) {
        return $output;
    }

    $output .= sprintf('<h4>%1$s</h4>%2$s', $title, PHP_EOL);
    $output .= sprintf('<div class="tabbody">%s', PHP_EOL);
    $output .= sprintf('%1$s%2$s', $content, PHP_EOL); 
    $output .= sprintf('</div>%s', PHP_EOL);
    
    return $output;    
});
