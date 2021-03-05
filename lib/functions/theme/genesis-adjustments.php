<?php
/**
 * KabelStar
 *
 * This file adds Genesis adjustment functions to the KabelStar Theme.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

// Genesis adjustments.
// Removes site layouts.
\genesis_unregister_layout( 'content-sidebar-sidebar' );
\genesis_unregister_layout( 'sidebar-content-sidebar' );
\genesis_unregister_layout( 'sidebar-sidebar-content' );
