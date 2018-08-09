<?php

    class Redux_Full_Package implements themecheck {
        protected $error = array();

        function check( $php_files, $css_files, $other_files ) {

            $ret = true;

            $check = Redux_ThemeCheck::get_instance();
            $redux = $check::get_redux_details( $php_files );

            if ( $redux ) {

                $blacklist = array(
                    '.tx'                    => esc_html__( 'Redux localization utilities', 'brando' ),
                    'bin'                    => esc_html__( 'Redux Resting Diles', 'brando' ),
                    'codestyles'             => esc_html__( 'Redux Code Styles', 'brando' ),
                    'tests'                  => esc_html__( 'Redux Unit Testing', 'brando' ),
                    'class.redux-plugin.php' => esc_html__( 'Redux Plugin File', 'brando' ),
                    'bootstrap_tests.php'    => esc_html__( 'Redux Boostrap Tests', 'brando' ),
                    '.travis.yml'            => esc_html__( 'CI Testing FIle', 'brando' ),
                    'phpunit.xml'            => esc_html__( 'PHP Unit Testing', 'brando' ),
                );

                $errors = array();

                foreach ( $blacklist as $file => $reason ) {
                    checkcount();
                    if ( file_exists( $redux['parent_dir'] . $file ) ) {
                        $errors[ $redux['parent_dir'] . $file ] = $reason;
                    }
                }

                if ( ! empty( $errors ) ) {
                    $error = '<span class="tc-lead tc-required">REQUIRED</span> ' . sprintf(__( 'It appears that you have embedded the full Redux package inside your theme. You need only embed the <strong>ReduxCore</strong> folder. Embedding anything else will get your rejected from theme submission. Suspected Redux package file(s):', 'brando' ));
                    $error .= '<ol>';
                    foreach ( $errors as $key => $e ) {
                        $error .= '<li><strong>' . $e . '</strong>: ' . $key . '</li>';
                    }
                    $error .= '</ol>';
                    $this->error[] = '<div class="redux-error">' . $error . '</div>';
                    $ret           = false;
                }
            }

            return $ret;
        }

        function getError() {
            return $this->error;
        }
    }

    $themechecks[] = new Redux_Full_Package();