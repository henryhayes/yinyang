<?php

include_once 'vfsStream/vfsStream.php';

class YinYang_Service_Iana_TldTest extends PHPUnit_Framework_TestCase
{
    /**
     * This tests that exception is thrown when non scalar value is used.
     */
    public function testGetInstance()
    {
        $sut = YinYang_Service_Iana_Tld::getInstance();

        $this->assertInstanceOf('YinYang_Service_Iana_Tld', $sut);
        $this->assertEquals(sys_get_temp_dir(), $sut->getTempPath());
    }

    /**
     * This tests that exception is thrown when non scalar value is used.
     */
    public function testSetTempPathWithNonScalarValueThrowsException()
    {
        $sut = new YinYang_Service_Iana_Tld();

        try {
            $fluent = $sut->setTempPath(array());
            $this->assertInstanceOf(get_class($sut), $fluent);
        } catch (YinYang_Exception $e) {
            $this->assertSame('Temp path must be a string', $e->getMessage());
            return;
        }

        $this->fail('Exception was not thrown');
    }

    /**
     * This tests that exception is thrown when path does not exist.
     */
    public function testSetTempPathNotExistThrowsException()
    {
        $path = '/etc/non-existent-file-path/notexist';

        $sut = new YinYang_Service_Iana_Tld();

        try {
            $fluent = $sut->setTempPath($path);
            $this->assertInstanceOf(get_class($sut), $fluent);
        } catch (YinYang_Exception $e) {
            $this->assertSame("Temp path does not exist, used: {$path}", $e->getMessage());
            return;
        }

        $this->fail('Exception was not thrown');
    }

    /**
     * This tests that exception is thrown when path does not exist.
     */
    public function testSetTempPathNotWritableThrowsException()
    {
        vfsStream::setup();
        vfsStream::newDirectory('tmp', 0000)->at(vfsStreamWrapper::getRoot());
        $path = vfsStream::url('tmp');

        $sut = new YinYang_Service_Iana_Tld();

        try {
            $fluent = $sut->setTempPath($path);
            $this->assertInstanceOf(get_class($sut), $fluent);
        } catch (YinYang_Exception $e) {
            $this->assertSame("Temp path is not writable, used: {$path}", $e->getMessage());
            return;
        }

        $this->fail('Exception was not thrown');
    }

    /**
     * This test ensures the temp path can be set and get.
     */
    public function testGetSetTempPath()
    {
        vfsStream::setup();
        vfsStream::newDirectory('tmp', 0777)->at(vfsStreamWrapper::getRoot());
        $path = vfsStream::url('tmp');

        $sut = new YinYang_Service_Iana_Tld();

        $fluent = $sut->setTempPath($path);
        $this->assertInstanceOf(get_class($sut), $fluent);

        $this->assertEquals($path, $sut->getTempPath());
    }

    /**
     * This test ensures the file name can be set and get.
     */
    public function testGetSetFileName()
    {
        $name = 'test-file-name.file';

        $sut = new YinYang_Service_Iana_Tld();

        $fluent = $sut->setTempFileName($name);
        $this->assertInstanceOf(get_class($sut), $fluent);

        $this->assertEquals($name, $sut->getTempFileName());
    }
    /**
     * This tests that exception is thrown when non scalar value is used.
     */
    public function testSetCacheTimeWithoutNumbersThrowsException()
    {
        $sut = new YinYang_Service_Iana_Tld();

        try {
            $fluent = $sut->setCacheTime('this is not a number');
            $this->assertInstanceOf(get_class($sut), $fluent);
        } catch (YinYang_Exception $e) {
            $this->assertSame('Cache time must be numeric', $e->getMessage());
            return;
        }

        $this->fail('Exception was not thrown');
    }

    /**
     * This test ensures the cache time can be set and get.
     */
    public function testGetSetCacheTime()
    {
        $seconds = 600;

        $sut = new YinYang_Service_Iana_Tld();

        $fluent = $sut->setCacheTime($seconds);
        $this->assertInstanceOf(get_class($sut), $fluent);

        $this->assertEquals($seconds, $sut->getCacheTime());
    }

    /**
     * This is a full integration test.
     */
    public function testFullIntegration()
    {
        $cacheSeconds = 1.5;

        $sut = new YinYang_Service_Iana_Tld();
        $sut->setCacheTime($cacheSeconds);

        vfsStream::setup();
        vfsStream::newDirectory('tmp', 0777)->at(vfsStreamWrapper::getRoot());
        $path = vfsStream::url('tmp');
        $sut->setTempPath($path);

        $fileName = 'fileName.tmp';
        $sut->setTempFileName($fileName);

        $fileWithPath = $path . DIRECTORY_SEPARATOR . $fileName;
        $this->assertFileNotExists($fileWithPath);

        $this->assertSame($this->crntTlds(), $sut->getTlds());

        $this->assertFileExists($fileWithPath);
    }

    /**
     * Return a list of current known TLDs.
     *
     * @return array
     */
    public function crntTlds()
    {
        return array (
            0 => 'ac',
            1 => 'ad',
            2 => 'ae',
            3 => 'aero',
            4 => 'af',
            5 => 'ag',
            6 => 'ai',
            7 => 'al',
            8 => 'am',
            9 => 'an',
            10 => 'ao',
            11 => 'aq',
            12 => 'ar',
            13 => 'arpa',
            14 => 'as',
            15 => 'asia',
            16 => 'at',
            17 => 'au',
            18 => 'aw',
            19 => 'ax',
            20 => 'az',
            21 => 'ba',
            22 => 'bb',
            23 => 'bd',
            24 => 'be',
            25 => 'bf',
            26 => 'bg',
            27 => 'bh',
            28 => 'bi',
            29 => 'biz',
            30 => 'bj',
            31 => 'bm',
            32 => 'bn',
            33 => 'bo',
            34 => 'br',
            35 => 'bs',
            36 => 'bt',
            37 => 'bv',
            38 => 'bw',
            39 => 'by',
            40 => 'bz',
            41 => 'ca',
            42 => 'cat',
            43 => 'cc',
            44 => 'cd',
            45 => 'cf',
            46 => 'cg',
            47 => 'ch',
            48 => 'ci',
            49 => 'ck',
            50 => 'cl',
            51 => 'cm',
            52 => 'cn',
            53 => 'co',
            54 => 'com',
            55 => 'coop',
            56 => 'cr',
            57 => 'cu',
            58 => 'cv',
            59 => 'cw',
            60 => 'cx',
            61 => 'cy',
            62 => 'cz',
            63 => 'de',
            64 => 'dj',
            65 => 'dk',
            66 => 'dm',
            67 => 'do',
            68 => 'dz',
            69 => 'ec',
            70 => 'edu',
            71 => 'ee',
            72 => 'eg',
            73 => 'er',
            74 => 'es',
            75 => 'et',
            76 => 'eu',
            77 => 'fi',
            78 => 'fj',
            79 => 'fk',
            80 => 'fm',
            81 => 'fo',
            82 => 'fr',
            83 => 'ga',
            84 => 'gb',
            85 => 'gd',
            86 => 'ge',
            87 => 'gf',
            88 => 'gg',
            89 => 'gh',
            90 => 'gi',
            91 => 'gl',
            92 => 'gm',
            93 => 'gn',
            94 => 'gov',
            95 => 'gp',
            96 => 'gq',
            97 => 'gr',
            98 => 'gs',
            99 => 'gt',
            100 => 'gu',
            101 => 'gw',
            102 => 'gy',
            103 => 'hk',
            104 => 'hm',
            105 => 'hn',
            106 => 'hr',
            107 => 'ht',
            108 => 'hu',
            109 => 'id',
            110 => 'ie',
            111 => 'il',
            112 => 'im',
            113 => 'in',
            114 => 'info',
            115 => 'int',
            116 => 'io',
            117 => 'iq',
            118 => 'ir',
            119 => 'is',
            120 => 'it',
            121 => 'je',
            122 => 'jm',
            123 => 'jo',
            124 => 'jobs',
            125 => 'jp',
            126 => 'ke',
            127 => 'kg',
            128 => 'kh',
            129 => 'ki',
            130 => 'km',
            131 => 'kn',
            132 => 'kp',
            133 => 'kr',
            134 => 'kw',
            135 => 'ky',
            136 => 'kz',
            137 => 'la',
            138 => 'lb',
            139 => 'lc',
            140 => 'li',
            141 => 'lk',
            142 => 'lr',
            143 => 'ls',
            144 => 'lt',
            145 => 'lu',
            146 => 'lv',
            147 => 'ly',
            148 => 'ma',
            149 => 'mc',
            150 => 'md',
            151 => 'me',
            152 => 'mg',
            153 => 'mh',
            154 => 'mil',
            155 => 'mk',
            156 => 'ml',
            157 => 'mm',
            158 => 'mn',
            159 => 'mo',
            160 => 'mobi',
            161 => 'mp',
            162 => 'mq',
            163 => 'mr',
            164 => 'ms',
            165 => 'mt',
            166 => 'mu',
            167 => 'museum',
            168 => 'mv',
            169 => 'mw',
            170 => 'mx',
            171 => 'my',
            172 => 'mz',
            173 => 'na',
            174 => 'name',
            175 => 'nc',
            176 => 'ne',
            177 => 'net',
            178 => 'nf',
            179 => 'ng',
            180 => 'ni',
            181 => 'nl',
            182 => 'no',
            183 => 'np',
            184 => 'nr',
            185 => 'nu',
            186 => 'nz',
            187 => 'om',
            188 => 'org',
            189 => 'pa',
            190 => 'pe',
            191 => 'pf',
            192 => 'pg',
            193 => 'ph',
            194 => 'pk',
            195 => 'pl',
            196 => 'pm',
            197 => 'pn',
            198 => 'post',
            199 => 'pr',
            200 => 'pro',
            201 => 'ps',
            202 => 'pt',
            203 => 'pw',
            204 => 'py',
            205 => 'qa',
            206 => 're',
            207 => 'ro',
            208 => 'rs',
            209 => 'ru',
            210 => 'rw',
            211 => 'sa',
            212 => 'sb',
            213 => 'sc',
            214 => 'sd',
            215 => 'se',
            216 => 'sg',
            217 => 'sh',
            218 => 'si',
            219 => 'sj',
            220 => 'sk',
            221 => 'sl',
            222 => 'sm',
            223 => 'sn',
            224 => 'so',
            225 => 'sr',
            226 => 'st',
            227 => 'su',
            228 => 'sv',
            229 => 'sx',
            230 => 'sy',
            231 => 'sz',
            232 => 'tc',
            233 => 'td',
            234 => 'tel',
            235 => 'tf',
            236 => 'tg',
            237 => 'th',
            238 => 'tj',
            239 => 'tk',
            240 => 'tl',
            241 => 'tm',
            242 => 'tn',
            243 => 'to',
            244 => 'tp',
            245 => 'tr',
            246 => 'travel',
            247 => 'tt',
            248 => 'tv',
            249 => 'tw',
            250 => 'tz',
            251 => 'ua',
            252 => 'ug',
            253 => 'uk',
            254 => 'us',
            255 => 'uy',
            256 => 'uz',
            257 => 'va',
            258 => 'vc',
            259 => 've',
            260 => 'vg',
            261 => 'vi',
            262 => 'vn',
            263 => 'vu',
            264 => 'wf',
            265 => 'ws',
            266 => 'xn',
            309 => 'xxx',
            310 => 'ye',
            311 => 'yt',
            312 => 'za',
            313 => 'zm',
            314 => 'zw',
        );
    }
}