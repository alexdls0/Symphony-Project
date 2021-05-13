<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Extends twig functionality, prividing video names
 */
class NameHelperExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('videotitle', [$this, 'getVideoName']),
        ];
    }

    /**
     *  Extract the title depending of the video type
     */
    public function getVideoName($video) {
        
        $string = $video->getTitulo();  
        
        if ( method_exists( $video, 'getTipo' ) && $video->getTipo() == 1 ) {
            
            // It is a cap OR the show itself
            if ( method_exists( $video, 'getTemporada' ) && method_exists( $video, 'getGrupo' ) ) {
                
                $eptitle = $video->getTitulo();
                $seasonnum = $video->getTemporada()->getOrden();
                $gname = $video->getGrupo()->getTitulo();
                
                $string = $gname . ' S'.$seasonnum . ': ' . $eptitle;
                
            }
            
        }
        return $string;
        
    }
}