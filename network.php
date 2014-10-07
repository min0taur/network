<?php
/* --------------------
Reference
http://en.wikipedia.org/wiki/Telephone_numbers_in_the_Philippines
USAGE:
 - Anong network ?
 $ano = new network();
 echo $ano->mobileNetwork(922); // 3digit access code lang
 - Smart ba ?
 $ano = new network();
 echo ( $ano->isSmart(928) ? 'Oo' : 'Hindi' );
 - Globe ?
 $ano = new network();
 echo ( $ano->isGlobe(928) ? 'Oo' : 'Hindi' ); 
 - SUN ?
 $ano = new network();
 echo ( $ano->isSun(928) ? 'Oo' : 'Hindi' ); 
*/
Class network {
    /* --------------------
    Smart/talkNtext
    */
    protected function _smart()
    {
        return array(
            '907', '908', '909',
            '912', '918', '919', '910',
            '921', '928', '929', '920',
            '938', '939', '930',
            '946', '947', '948', '949',
            '989',
            '998', '999'
        );
    }
    /* --------------------
    GLOBE/TM
    */
    protected function _globe()
    {
        return array(
            '817',
            '905', '906',
            '915', '916', '917',
            '926', '927',
            '935', '936', '937',
            '975', '977',
            '994', '996', '997'
        );
    }
    /* --------------------
    SUN
    */
    protected function _sun()
    {
        return array(
            '922', '923', '925',
            '932', '933', '934',
            '942', '943'
        );
    }
    /* --------------------
    Anong network
    */
    public function mobileNetwork($prefix)
    {
        if( in_array($prefix, $this->_smart()) ) return 'Smart';
        if( in_array($prefix, $this->_globe()) ) return 'Globe';
        if( in_array($prefix, $this->_sun()) ) return 'Sun';
    }
    /* --------------------
    Match mobile network
    */
    protected function _match()
    {
        // SMART/TNT
        $smart = $this->_smart();
        if( $this->name == 'smart' ) return in_array($this->args, $smart) ? true : false;
        // GLOBE/TM
        $globe = $this->_globe();
        if( $this->name == 'globe' ) return in_array($this->args, $globe) ? true : false;
        // SUN
        $sun = $this->_sun();
        if( $this->name == 'sun' ) return in_array($this->args, $sun) ? true : false;
    }
    public function __call($name, $args)
    {
        //make sure the name starts with 'is', otherwise
        if( substr($name, 0, 2) != 'is' ) {
            die($name.' not found');
        }
        $this->name = strtolower(substr($name, 2));
        $this->args = $args[0];
        return $this->_match();
    }
}
