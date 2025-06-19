<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 *  Video Player filtering
 *
 *  This filter generate a video player
 *
 * @package    filter_mirocoursesinfos
 * @copyright  2025 Samuel Calegari <samuel.calegari@univ-perp.fr>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace filter_miroplayer;

defined('MOODLE_INTERNAL') || die();

class text_filter extends \core_filters\text_filter {

    public function filter($text, array $options = []) {

        if (!is_string($text) or empty($text)) {
            return $text;
        }

        if (strpos($text, '[player') === false) {
            return $text;
        }

        $text = preg_replace_callback(
            "/\[[^\[]*player[^\]]*\]/",
            array( &$this, "gen_player" ),
            $text);


        return $text;
    }

    private function gen_player($m) {

        $html = '';

        $regex = '/(\w+)\s*=\s*"(.*?)"/';

        preg_match_all($regex, $m[0], $matches);

        $options= array();
        for ($i = 0; $i < count($matches[1]); $i++)
            $options[$matches[1][$i]] = $matches[2][$i];

        $ratio = @isset($options['ratio']) ? $options['ratio'] : '16by9';
        $title = @isset($options['title']) ? $options['title'] : '';
        $video = $options['video'];

        if(strpos($video, 'youtube-')!== false)
            $url = '//www.youtube.com/embed/' . str_replace('youtube-','',$video)  . '?rel=0';
        elseif(strpos($video, 'dailymotion-')!== false)
            $url = '//www.dailymotion.com/embed/video/' . str_replace('dailymotion-','',$video);
        elseif(strpos($video, 'vimeo-')!== false)
            $url = '//player.vimeo.com/video/' . str_replace('vimeo-','',$video);
        elseif(strpos($video, 'upvdstream-')!== false)
            $url = 'https://upvdstream.univ-perp.fr/video/player.php?id=' . str_replace('upvdstream-','',$video) . '&cover=cover2';
        elseif(strpos($video, 'mediaserver-')!== false)
            $url = 'https://mediaserver.univ-perp.fr/permalink/' . str_replace('mediaserver-','',$video) . '/iframe/';
        else return $html;

        $html .= '<div class="container">';
        $html .= '<div class="row">';
        $html .= '<div class="col-sm-12">';
        $html .= '<div class="card text-center">';
        $html .= '<div class="card-block">';
        $html .= '<div class="embed-responsive embed-responsive-' . $ratio . '">';
        $html .= '<iframe class="embed-responsive-item" title="' . $title . '" src="' . $url . '" allowfullscreen></iframe>';
        $html .= '</div>';
        $html .= '</div>';
        if($title!="")
            $html .= '<div class="card-footer text-muted">' . $title . '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }
}
