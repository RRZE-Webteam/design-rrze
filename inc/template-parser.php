<?php
class Template_Parser {

	const l_delim = '[';
	const r_delim = ']';

    public static function print_template( $data = array(), $template = '', $l_str = '', $r_str = '' ) {
        $script = sprintf( '%s/%s.php', get_template_directory(), $template );
        $template = self::parse( $script, $data, $l_str, $r_str );
            
        echo $template;
    }

	public static function parse( $template, $data, $l_str, $r_str ) {
        if ( is_file( $template ) ) {
            ob_start();
            include $template;
            $template = sprintf( '%1$s%3$s%2$s', $l_str, $r_str, ob_get_contents() );
            @ob_end_clean();

            return self::render( $template, $data );
        }
        
        return false;
	}

	private static function render( $template, $data ) {
		if ( $template == '' )
            return false;

		foreach ( $data as $key => $val ) {
			if ( is_array( $val ) )
				$template = self::render_pair( $key, $val, $template );
			else
				$template = self::render_single( $key, (string)$val, $template );

		}

		return $template;
	}

	private static function render_single( $key, $val, $string ) {
		return str_replace( self::l_delim.$key.self::r_delim, $val, $string );
	}

	private static function render_pair( $variable, $data, $string ) {
		if( false === ( $match = self::match_pair( $string, $variable ) ) )
			return $string;

		$str = '';
		foreach ( $data as $row ) {
			$temp = $match['1'];
			foreach ( $row as $key => $val ) {
				if( ! is_array( $val ) )
					$temp = self::render_single( $key, $val, $temp );
				else
					$temp = self::render_pair( $key, $val, $temp );
			}

			$str .= $temp;
		}

		return str_replace( $match['0'], $str, $string );
	}

	private static function match_pair( $string, $variable ) {
		if ( ! preg_match( "|" . preg_quote( self::l_delim ) . $variable . preg_quote( self::r_delim ) . "(.+?)". preg_quote( self::l_delim ) . '/' . $variable . preg_quote( self::r_delim ) . "|s", $string, $match ) )
			return false;

		return $match;
	}

}
