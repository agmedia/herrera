/**
 * speakingurl
 * @version v9.0.0
 * @link http://pid.github.io/speakingurl/
 * @license BSD
 * @author Sascha Droste
 */!function(e,a){"use strict";var n=function(e,a){var n,t,u,l,s,r,m,c,h,d,g,k,f,y,p,A="-",b=[";","?",":","@","&","=","+","$",",","/"],z=[";","?",":","@","&","=","+","$",","],E=[".","!","~","*","'","(",")"],j="",S="",O=!0,v={},w={"À":"A","Á":"A","Â":"A","Ã":"A","Ä":"Ae","Å":"A","Æ":"AE","Ç":"C","È":"E","É":"E","Ê":"E","Ë":"E","Ì":"I","Í":"I","Î":"I","Ï":"I","Ð":"D","Ñ":"N","Ò":"O","Ó":"O","Ô":"O","Õ":"O","Ö":"Oe","Ő":"O","Ø":"O","Ù":"U","Ú":"U","Û":"U","Ü":"Ue","Ű":"U","Ý":"Y","Þ":"TH","ß":"ss","à":"a","á":"a","â":"a","ã":"a","ä":"ae","å":"a","æ":"ae","ç":"c","è":"e","é":"e","ê":"e","ë":"e","ì":"i","í":"i","î":"i","ï":"i","ð":"d","ñ":"n","ò":"o","ó":"o","ô":"o","õ":"o","ö":"oe","ő":"o","ø":"o","ù":"u","ú":"u","û":"u","ü":"ue","ű":"u","ý":"y","þ":"th","ÿ":"y","ẞ":"SS","ا":"a","أ":"a","إ":"i","آ":"aa","ؤ":"u","ئ":"e","ء":"a","ب":"b","ت":"t","ث":"th","ج":"j","ح":"h","خ":"kh","د":"d","ذ":"th","ر":"r","ز":"z","س":"s","ش":"sh","ص":"s","ض":"dh","ط":"t","ظ":"z","ع":"a","غ":"gh","ف":"f","ق":"q","ك":"k","ل":"l","م":"m","ن":"n","ه":"h","و":"w","ي":"y","ى":"a","ة":"h","ﻻ":"la","ﻷ":"laa","ﻹ":"lai","ﻵ":"laa","َ":"a","ً":"an","ِ":"e","ٍ":"en","ُ":"u","ٌ":"on","ْ":"","٠":"0","١":"1","٢":"2","٣":"3","٤":"4","٥":"5","٦":"6","٧":"7","٨":"8","٩":"9","က":"k","ခ":"kh","ဂ":"g","ဃ":"ga","င":"ng","စ":"s","ဆ":"sa","ဇ":"z","စျ":"za","ည":"ny","ဋ":"t","ဌ":"ta","ဍ":"d","ဎ":"da","ဏ":"na","တ":"t","ထ":"ta","ဒ":"d","ဓ":"da","န":"n","ပ":"p","ဖ":"pa","ဗ":"b","ဘ":"ba","မ":"m","ယ":"y","ရ":"ya","လ":"l","ဝ":"w","သ":"th","ဟ":"h","ဠ":"la","အ":"a","ြ":"y","ျ":"ya","ွ":"w","ြွ":"yw","ျွ":"ywa","ှ":"h","ဧ":"e","၏":"-e","ဣ":"i","ဤ":"-i","ဉ":"u","ဦ":"-u","ဩ":"aw","သြော":"aw","ဪ":"aw","၀":"0","၁":"1","၂":"2","၃":"3","၄":"4","၅":"5","၆":"6","၇":"7","၈":"8","၉":"9","္":"","့":"","း":"","č":"c","ď":"d","ě":"e","ň":"n","ř":"r","š":"s","ť":"t","ů":"u","ž":"z","Č":"C","Ď":"D","Ě":"E","Ň":"N","Ř":"R","Š":"S","Ť":"T","Ů":"U","Ž":"Z","ހ":"h","ށ":"sh","ނ":"n","ރ":"r","ބ":"b","ޅ":"lh","ކ":"k","އ":"a","ވ":"v","މ":"m","ފ":"f","ދ":"dh","ތ":"th","ލ":"l","ގ":"g","ޏ":"gn","ސ":"s","ޑ":"d","ޒ":"z","ޓ":"t","ޔ":"y","ޕ":"p","ޖ":"j","ޗ":"ch","ޘ":"tt","ޙ":"hh","ޚ":"kh","ޛ":"th","ޜ":"z","ޝ":"sh","ޞ":"s","ޟ":"d","ޠ":"t","ޡ":"z","ޢ":"a","ޣ":"gh","ޤ":"q","ޥ":"w","ަ":"a","ާ":"aa","ި":"i","ީ":"ee","ު":"u","ޫ":"oo","ެ":"e","ޭ":"ey","ޮ":"o","ޯ":"oa","ް":"","α":"a","β":"v","γ":"g","δ":"d","ε":"e","ζ":"z","η":"i","θ":"th","ι":"i","κ":"k","λ":"l","μ":"m","ν":"n","ξ":"ks","ο":"o","π":"p","ρ":"r","σ":"s","τ":"t","υ":"y","φ":"f","χ":"x","ψ":"ps","ω":"o","ά":"a","έ":"e","ί":"i","ό":"o","ύ":"y","ή":"i","ώ":"o","ς":"s","ϊ":"i","ΰ":"y","ϋ":"y","ΐ":"i","Α":"A","Β":"B","Γ":"G","Δ":"D","Ε":"E","Ζ":"Z","Η":"I","Θ":"TH","Ι":"I","Κ":"K","Λ":"L","Μ":"M","Ν":"N","Ξ":"KS","Ο":"O","Π":"P","Ρ":"R","Σ":"S","Τ":"T","Υ":"Y","Φ":"F","Χ":"X","Ψ":"PS","Ω":"W","Ά":"A","Έ":"E","Ί":"I","Ό":"O","Ύ":"Y","Ή":"I","Ώ":"O","Ϊ":"I","Ϋ":"Y","ā":"a","ē":"e","ģ":"g","ī":"i","ķ":"k","ļ":"l","ņ":"n","ū":"u","Ā":"A","Ē":"E","Ģ":"G","Ī":"I","Ķ":"k","Ļ":"L","Ņ":"N","Ū":"U","Ќ":"Kj","ќ":"kj","Љ":"Lj","љ":"lj","Њ":"Nj","њ":"nj","Тс":"Ts","тс":"ts","ą":"a","ć":"c","ę":"e","ł":"l","ń":"n","ś":"s","ź":"z","ż":"z","Ą":"A","Ć":"C","Ę":"E","Ł":"L","Ń":"N","Ś":"S","Ź":"Z","Ż":"Z","Є":"Ye","І":"I","Ї":"Yi","Ґ":"G","є":"ye","і":"i","ї":"yi","ґ":"g","ă":"a","Ă":"A","ș":"s","Ș":"S","ț":"t","Ț":"T","ţ":"t","Ţ":"T","а":"a","б":"b","в":"v","г":"g","д":"d","е":"e","ё":"yo","ж":"zh","з":"z","и":"i","й":"i","к":"k","л":"l","м":"m","н":"n","о":"o","п":"p","р":"r","с":"s","т":"t","у":"u","ф":"f","х":"kh","ц":"c","ч":"ch","ш":"sh","щ":"sh","ъ":"","ы":"y","ь":"","э":"e","ю":"yu","я":"ya","А":"A","Б":"B","В":"V","Г":"G","Д":"D","Е":"E","Ё":"Yo","Ж":"Zh","З":"Z","И":"I","Й":"I","К":"K","Л":"L","М":"M","Н":"N","О":"O","П":"P","Р":"R","С":"S","Т":"T","У":"U","Ф":"F","Х":"Kh","Ц":"C","Ч":"Ch","Ш":"Sh","Щ":"Sh","Ъ":"","Ы":"Y","Ь":"","Э":"E","Ю":"Yu","Я":"Ya","ђ":"dj","ј":"j","ћ":"c","џ":"dz","Ђ":"Dj","Ј":"j","Ћ":"C","Џ":"Dz","ľ":"l","ĺ":"l","ŕ":"r","Ľ":"L","Ĺ":"L","Ŕ":"R","ş":"s","Ş":"S","ı":"i","İ":"I","ğ":"g","Ğ":"G","ả":"a","Ả":"A","ẳ":"a","Ẳ":"A","ẩ":"a","Ẩ":"A","đ":"d","Đ":"D","ẹ":"e","Ẹ":"E","ẽ":"e","Ẽ":"E","ẻ":"e","Ẻ":"E","ế":"e","Ế":"E","ề":"e","Ề":"E","ệ":"e","Ệ":"E","ễ":"e","Ễ":"E","ể":"e","Ể":"E","ọ":"o","Ọ":"o","ố":"o","Ố":"O","ồ":"o","Ồ":"O","ổ":"o","Ổ":"O","ộ":"o","Ộ":"O","ỗ":"o","Ỗ":"O","ơ":"o","Ơ":"O","ớ":"o","Ớ":"O","ờ":"o","Ờ":"O","ợ":"o","Ợ":"O","ỡ":"o","Ỡ":"O","Ở":"o","ở":"o","ị":"i","Ị":"I","ĩ":"i","Ĩ":"I","ỉ":"i","Ỉ":"i","ủ":"u","Ủ":"U","ụ":"u","Ụ":"U","ũ":"u","Ũ":"U","ư":"u","Ư":"U","ứ":"u","Ứ":"U","ừ":"u","Ừ":"U","ự":"u","Ự":"U","ữ":"u","Ữ":"U","ử":"u","Ử":"ư","ỷ":"y","Ỷ":"y","ỳ":"y","Ỳ":"Y","ỵ":"y","Ỵ":"Y","ỹ":"y","Ỹ":"Y","ạ":"a","Ạ":"A","ấ":"a","Ấ":"A","ầ":"a","Ầ":"A","ậ":"a","Ậ":"A","ẫ":"a","Ẫ":"A","ắ":"a","Ắ":"A","ằ":"a","Ằ":"A","ặ":"a","Ặ":"A","ẵ":"a","Ẵ":"A","“":'"',"”":'"',"‘":"'","’":"'","∂":"d","ƒ":"f","™":"(TM)","©":"(C)","œ":"oe","Œ":"OE","®":"(R)","†":"+","℠":"(SM)","…":"...","˚":"o","º":"o","ª":"a","•":"*","၊":",","။":".",$:"USD","€":"EUR","₢":"BRN","₣":"FRF","£":"GBP","₤":"ITL","₦":"NGN","₧":"ESP","₩":"KRW","₪":"ILS","₫":"VND","₭":"LAK","₮":"MNT","₯":"GRD","₱":"ARS","₲":"PYG","₳":"ARA","₴":"UAH","₵":"GHS","¢":"cent","¥":"CNY","元":"CNY","円":"YEN","﷼":"IRR","₠":"EWE","฿":"THB","₨":"INR","₹":"INR","₰":"PF"},U=["်","ް"],C={"ာ":"a","ါ":"a","ေ":"e","ဲ":"e","ိ":"i","ီ":"i","ို":"o","ု":"u","ူ":"u","ေါင်":"aung","ော":"aw","ော်":"aw","ေါ":"aw","ေါ်":"aw","်":"်","က်":"et","ိုက်":"aik","ောက်":"auk","င်":"in","ိုင်":"aing","ောင်":"aung","စ်":"it","ည်":"i","တ်":"at","ိတ်":"eik","ုတ်":"ok","ွတ်":"ut","ေတ်":"it","ဒ်":"d","ိုဒ်":"ok","ုဒ်":"ait","န်":"an","ာန်":"an","ိန်":"ein","ုန်":"on","ွန်":"un","ပ်":"at","ိပ်":"eik","ုပ်":"ok","ွပ်":"ut","န်ုပ်":"nub","မ်":"an","ိမ်":"ein","ုမ်":"on","ွမ်":"un","ယ်":"e","ိုလ်":"ol","ဉ်":"in","ံ":"an","ိံ":"ein","ုံ":"on","ައް":"ah","ަށް":"ah"},I={en:{},az:{"ç":"c","ə":"e","ğ":"g","ı":"i","ö":"o","ş":"s","ü":"u","Ç":"C","Ə":"E","Ğ":"G","İ":"I","Ö":"O","Ş":"S","Ü":"U"},cs:{"č":"c","ď":"d","ě":"e","ň":"n","ř":"r","š":"s","ť":"t","ů":"u","ž":"z","Č":"C","Ď":"D","Ě":"E","Ň":"N","Ř":"R","Š":"S","Ť":"T","Ů":"U","Ž":"Z"},fi:{"ä":"a","Ä":"A","ö":"o","Ö":"O"},hu:{"ä":"a","Ä":"A","ö":"o","Ö":"O","ü":"u","Ü":"U","ű":"u","Ű":"U"},lt:{"ą":"a","č":"c","ę":"e","ė":"e","į":"i","š":"s","ų":"u","ū":"u","ž":"z","Ą":"A","Č":"C","Ę":"E","Ė":"E","Į":"I","Š":"S","Ų":"U","Ū":"U"},lv:{"ā":"a","č":"c","ē":"e","ģ":"g","ī":"i","ķ":"k","ļ":"l","ņ":"n","š":"s","ū":"u","ž":"z","Ā":"A","Č":"C","Ē":"E","Ģ":"G","Ī":"i","Ķ":"k","Ļ":"L","Ņ":"N","Š":"S","Ū":"u","Ž":"Z"},pl:{"ą":"a","ć":"c","ę":"e","ł":"l","ń":"n","ó":"o","ś":"s","ź":"z","ż":"z","Ą":"A","Ć":"C","Ę":"e","Ł":"L","Ń":"N","Ó":"O","Ś":"S","Ź":"Z","Ż":"Z"},sk:{"ä":"a","Ä":"A"},sr:{"љ":"lj","њ":"nj","Љ":"Lj","Њ":"Nj","đ":"dj","Đ":"Dj"},tr:{"Ü":"U","Ö":"O","ü":"u","ö":"o"}},N={ar:{"∆":"delta","∞":"la-nihaya","♥":"hob","&":"wa","|":"aw","<":"aqal-men",">":"akbar-men","∑":"majmou","¤":"omla"},az:{},ca:{"∆":"delta","∞":"infinit","♥":"amor","&":"i","|":"o","<":"menys que",">":"mes que","∑":"suma dels","¤":"moneda"},cz:{"∆":"delta","∞":"nekonecno","♥":"laska","&":"a","|":"nebo","<":"mene jako",">":"vice jako","∑":"soucet","¤":"mena"},de:{"∆":"delta","∞":"unendlich","♥":"Liebe","&":"und","|":"oder","<":"kleiner als",">":"groesser als","∑":"Summe von","¤":"Waehrung"},dv:{"∆":"delta","∞":"kolunulaa","♥":"loabi","&":"aai","|":"noonee","<":"ah vure kuda",">":"ah vure bodu","∑":"jumula","¤":"faisaa"},en:{"∆":"delta","∞":"infinity","♥":"love","&":"and","|":"or","<":"less than",">":"greater than","∑":"sum","¤":"currency"},es:{"∆":"delta","∞":"infinito","♥":"amor","&":"y","|":"u","<":"menos que",">":"mas que","∑":"suma de los","¤":"moneda"},fr:{"∆":"delta","∞":"infiniment","♥":"Amour","&":"et","|":"ou","<":"moins que",">":"superieure a","∑":"somme des","¤":"monnaie"},gr:{},hu:{"∆":"delta","∞":"vegtelen","♥":"szerelem","&":"es","|":"vagy","<":"kisebb mint",">":"nagyobb mint","∑":"szumma","¤":"penznem"},it:{"∆":"delta","∞":"infinito","♥":"amore","&":"e","|":"o","<":"minore di",">":"maggiore di","∑":"somma","¤":"moneta"},lt:{},lv:{"∆":"delta","∞":"bezgaliba","♥":"milestiba","&":"un","|":"vai","<":"mazak neka",">":"lielaks neka","∑":"summa","¤":"valuta"},my:{"∆":"kwahkhyaet","∞":"asaonasme","♥":"akhyait","&":"nhin","|":"tho","<":"ngethaw",">":"kyithaw","∑":"paungld","¤":"ngwekye"},mk:{},nl:{"∆":"delta","∞":"oneindig","♥":"liefde","&":"en","|":"of","<":"kleiner dan",">":"groter dan","∑":"som","¤":"valuta"},pl:{"∆":"delta","∞":"nieskonczonosc","♥":"milosc","&":"i","|":"lub","<":"mniejsze niz",">":"wieksze niz","∑":"suma","¤":"waluta"},pt:{"∆":"delta","∞":"infinito","♥":"amor","&":"e","|":"ou","<":"menor que",">":"maior que","∑":"soma","¤":"moeda"},ro:{"∆":"delta","∞":"infinit","♥":"dragoste","&":"si","|":"sau","<":"mai mic ca",">":"mai mare ca","∑":"suma","¤":"valuta"},ru:{"∆":"delta","∞":"beskonechno","♥":"lubov","&":"i","|":"ili","<":"menshe",">":"bolshe","∑":"summa","¤":"valjuta"},sk:{"∆":"delta","∞":"nekonecno","♥":"laska","&":"a","|":"alebo","<":"menej ako",">":"viac ako","∑":"sucet","¤":"mena"},sr:{},tr:{"∆":"delta","∞":"sonsuzluk","♥":"ask","&":"ve","|":"veya","<":"kucuktur",">":"buyuktur","∑":"toplam","¤":"para birimi"},uk:{"∆":"delta","∞":"bezkinechnist","♥":"lubov","&":"i","|":"abo","<":"menshe",">":"bilshe","∑":"suma","¤":"valjuta"},vn:{"∆":"delta","∞":"vo cuc","♥":"yeu","&":"va","|":"hoac","<":"nho hon",">":"lon hon","∑":"tong","¤":"tien te"}};if("string"!=typeof e)return"";if("string"==typeof a&&(A=a),m=N.en,c=I.en,"object"==typeof a){n=a.maintainCase||!1,v=a.custom&&"object"==typeof a.custom?a.custom:v,u=+a.truncate>1&&a.truncate||!1,l=a.uric||!1,s=a.uricNoSlash||!1,r=a.mark||!1,O=a.symbols===!1||a.lang===!1?!1:!0,A=a.separator||A,l&&(p+=b.join("")),s&&(p+=z.join("")),r&&(p+=E.join("")),m=a.lang&&N[a.lang]&&O?N[a.lang]:O?N.en:{},c=a.lang&&I[a.lang]?I[a.lang]:a.lang===!1||a.lang===!0?{}:I.en,a.titleCase&&"number"==typeof a.titleCase.length&&Array.prototype.toString.call(a.titleCase)?(a.titleCase.forEach(function(e){v[e+""]=e+""}),t=!0):t=!!a.titleCase,a.custom&&"number"==typeof a.custom.length&&Array.prototype.toString.call(a.custom)&&a.custom.forEach(function(e){v[e+""]=e+""}),Object.keys(v).forEach(function(a){var n;n=a.length>1?new RegExp("\\b"+o(a)+"\\b","gi"):new RegExp(o(a),"gi"),e=e.replace(n,v[a])});for(g in v)p+=g}for(p+=A,p=o(p),e=e.replace(/(^\s+|\s+$)/g,""),f=!1,y=!1,d=0,k=e.length;k>d;d++)g=e[d],i(g,v)?f=!1:c[g]?(g=f&&c[g].match(/[A-Za-z0-9]/)?" "+c[g]:c[g],f=!1):g in w?(k>d+1&&U.indexOf(e[d+1])>=0?(S+=g,g=""):y===!0?(g=C[S]+w[g],S=""):g=f&&w[g].match(/[A-Za-z0-9]/)?" "+w[g]:w[g],f=!1,y=!1):g in C?(S+=g,g="",d===k-1&&(g=C[S]),y=!0):!m[g]||l&&-1!==b.join("").indexOf(g)||s&&-1!==z.join("").indexOf(g)?(y===!0?(g=C[S]+g,S="",y=!1):f&&(/[A-Za-z0-9]/.test(g)||j.substr(-1).match(/A-Za-z0-9]/))&&(g=" "+g),f=!1):(g=f||j.substr(-1).match(/[A-Za-z0-9]/)?A+m[g]:m[g],g+=void 0!==e[d+1]&&e[d+1].match(/[A-Za-z0-9]/)?A:"",f=!0),j+=g.replace(new RegExp("[^\\w\\s"+p+"_-]","g"),A);return t&&(j=j.replace(/(\w)(\S*)/g,function(e,a,n){var t=a.toUpperCase()+(null!==n?n:"");return Object.keys(v).indexOf(t.toLowerCase())<0?t:t.toLowerCase()})),j=j.replace(/\s+/g,A).replace(new RegExp("\\"+A+"+","g"),A).replace(new RegExp("(^\\"+A+"+|\\"+A+"+$)","g"),""),u&&j.length>u&&(h=j.charAt(u)===A,j=j.slice(0,u),h||(j=j.slice(0,j.lastIndexOf(A)))),n||t||(j=j.toLowerCase()),j},t=function(e){return function(a){return n(a,e)}},o=function(e){return e.replace(/[-\\^$*+?.()|[\]{}\/]/g,"\\$&")},i=function(e,a){for(var n in a)if(a[n]===e)return!0};if("undefined"!=typeof module&&module.exports)module.exports=n,module.exports.createSlug=t;else if("undefined"!=typeof define&&define.amd)define([],function(){return n});else try{if(e.getSlug||e.createSlug)throw"speakingurl: globals exists /(getSlug|createSlug)/";e.getSlug=n,e.createSlug=t}catch(u){}}(this);

 /**
 * jquery.stringtoslug - Convert a STRING to a SLUG (kebab-case) in any language
 * @version v2.1.0
 * @link https://leocaseiro.github.com/jQuery-Plugin-stringToSlug
 * @license MIT
 */
var _stringToSlug_API=function(e,t){"use strict";var r,s={setEvents:"keyup keydown blur",getPut:"#permalink",space:"-",prefix:"",suffix:"",replace:"",AND:"and",options:{},callback:!1};jQuery.extend(s,t),s.options.hasOwnProperty("separator")||(s.options.separator=s.space),s.options.hasOwnProperty("custom")||(s.options.custom={"&":s.AND}),e=e.replace(s.replace,"");try{e=getSlug(e,s.options)}catch(n){console.warn("Make sure you insert speakingurl.min.js before jquery.stringtoslug.min.js")}return r=s.prefix+e+s.suffix};jQuery.fn.stringToSlug=function(e){"use strict";var t={setEvents:"keyup keydown blur",getPut:"#permalink",space:"-",prefix:"",suffix:"",replace:"",AND:"and",callback:!1};return jQuery.extend(t,e),jQuery(this).bind(t.setEvents,function(){var r=jQuery(this).val(),s=_stringToSlug_API(r,e);return jQuery(t.getPut).val(s),jQuery(t.getPut).html(s),!1!==t.callback&&t.callback(s),this}),this};