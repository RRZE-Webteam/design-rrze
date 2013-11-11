<?php
echo <<<EOL
@media screen {
EOL;
echo PHP_EOL;

if( $data['column.layout'] == '1-2-3' ) :
echo <<<EOL
    #main-column > .ym-col1 { width: 25%; } /* left column */
    #main-column > .ym-col2 { width: 25%; } /* right column */
    #main-column > .ym-col3 { margin: 0 25%; } /* center column */
EOL;
elseif( $data['column.layout'] == '1-3' ) :
echo <<<EOL
    #main-column > .ym-col1 { width: 25%; } /* sidebar */
    #main-column > .ym-col3 { float: right; width: 75%; margin: 0;} /* content */
EOL;
elseif( $data['column.layout'] == '2-3' ) :
echo <<<EOL
    #main-column > .ym-col2 { width: 25%; } /* sidebar */
    #main-column > .ym-col3 { float: left; width: 75%; margin: 0;} /* content */
EOL;
endif;
echo PHP_EOL;

if( $data['footer.layout'] == '100' ) :
echo <<<EOL
    footer aside.ym-col1 { width: 100%; margin: 0;}
EOL;
elseif( $data['footer.layout'] == '25-25-50' ) :
echo <<<EOL
    footer aside.ym-col1 { width: 25%; margin: 0;} /* left column */
    footer aside.ym-col2 { width: 25%; float:left; margin: 0; } /* center column */
    footer aside.ym-col3 { margin-left: 50%; margin-right: 0; } /* right column */
EOL;
elseif( $data['footer.layout'] == '25-50-25' ) :
echo <<<EOL
    footer aside.ym-col1 { width: 25%; margin: 0;} /* left column */
    footer aside.ym-col2 { width: 50%; float:left; margin: 0; } /* center column */
    footer aside.ym-col3 { margin-left: 75%; margin-right: 0; } /* right column */
EOL;
elseif( $data['footer.layout'] == '25-75' ) :
echo <<<EOL
    footer aside.ym-col1 { width: 25%; margin: 0;} /* left column */
    footer aside.ym-col2 { width: 75%; float:left; margin: 0; } /* right column */
EOL;
elseif( $data['footer.layout'] == '33-33-33' ) :
echo <<<EOL
    footer aside.ym-col1 { width: 33.333%; margin: 0;} /* left column */
    footer aside.ym-col2 { width: 33.333%; float:left; margin: 0; } /* center column */
    footer aside.ym-col3 { margin-left: 66.666%; margin-right: 0; } /* right column */
EOL;
elseif( $data['footer.layout'] == '33-66' ) :
echo <<<EOL
    footer aside.ym-col1 { width: 33.333%; margin: 0;} /* left column */
    footer aside.ym-col2 { width: 66.666%; float:left; margin: 0; } /* right column */
EOL;
elseif( $data['footer.layout'] == '38-62' ) :
echo <<<EOL
    footer aside.ym-col1 { width: 38%; margin: 0;} /* left column */
    footer aside.ym-col2 { width: 62%; float:left; margin: 0; } /* right column */
EOL;
elseif( $data['footer.layout'] == '40-60' ) :
echo <<<EOL
    footer aside.ym-col1 { width: 40%; margin: 0;} /* left column */
    footer aside.ym-col2 { width: 60%; float:left; margin: 0; } /* right column */
EOL;
elseif( $data['footer.layout'] == '50-25-25' ) :
echo <<<EOL
    footer aside.ym-col1 { width: 50%; margin: 0;} /* left column */
    footer aside.ym-col2 { width: 25%; float:left; margin: 0; } /* center column */
    footer aside.ym-col3 { margin-left: 75%; margin-right: 0; } /* right column */
EOL;
elseif( $data['footer.layout'] == '50-50' ) :
echo <<<EOL
    footer aside.ym-col1 { width: 50%; margin: 0;} /* left column */
    footer aside.ym-col2 { width: 50%; float:left; margin: 0; } /* right column */
EOL;
elseif( $data['footer.layout'] == '60-40' ) :
echo <<<EOL
    footer aside.ym-col1 { width: 60%; margin: 0;} /* left column */
    footer aside.ym-col2 { width: 40%; float:left; margin: 0; } /* right column */
EOL;
elseif( $data['footer.layout'] == '62-38' ) :
echo <<<EOL
    footer aside.ym-col1 { width: 62%; margin: 0;} /* left column */
    footer aside.ym-col2 { width: 38%; float:left; margin: 0; } /* right column */
EOL;
elseif( $data['footer.layout'] == '66-33' ) :
echo <<<EOL
    footer aside.ym-col1 { width: 66.666%; margin: 0;} /* left column */
    footer aside.ym-col2 { width: 33.333%; float:left; margin: 0; } /* right column */
EOL;
elseif( $data['footer.layout'] == '75-25' ) :
echo <<<EOL
    footer aside.ym-col1 { width: 75%; margin: 0;} /* left column */
    footer aside.ym-col2 { width: 25%; float:left; margin: 0; } /* right column */
EOL;
endif;

echo PHP_EOL;
echo <<<EOL
}
EOL;
