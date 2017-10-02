<?php
namespace IodogsApplication\Service;

use \IodogsApplication\Interfaces\IodogsServiceInterface;

class ContentService implements IodogsServiceInterface
{

    protected $om;

    public function __construct($objectManager)
    {
        $this->om = $objectManager;
    }

    public function findPageBySlug($slug)
    {
        $PageContent = $this->om-> getRepository('IodogsDoctrine\Entity\Content')->
        findOneBy(array('href' => $slug, 'active' => 1));
        return $PageContent;
    }


    public function checkInstance($instance)
    {
        if($instance instanceof \IodogsDoctrine\Entity\Content)
            return true;
        return false;
    }

    public function getViewArray($ContentEntity)
    {
        $viewArray = array();
        if($this->checkInstance($ContentEntity))
        {
            $viewArray = array(
                'id' => $ContentEntity->getId(),
                'href' => $ContentEntity->getHref(),
                'title' => $ContentEntity->getTitle(),
                'header' => $ContentEntity->getHeader(),
                'snippet' => $ContentEntity->getSnippet(),
                'keywords' => $ContentEntity->getKeywords(),
                'active' => $ContentEntity->getActive(),
                'decription' => $ContentEntity->getDescription(),
                'content' => $ContentEntity->getContent(),
                'aphorism' => $this->getRandAphorism(),
                'date_update' => $ContentEntity->getDateUpdate(),
            );
        }
        return $viewArray;
    }

    public function getRandAphorism()
    {
        $aphorism[] = array("content" => "В том, что собаки начинают походить на своих хозяев, нет ничего удивительного. И у тех, и у других жизнь собачья. ", "author" => "Валентин Домиль ");
        $aphorism[] = array("content" => "Все равно: человек заводит собаку, чтобы не было чувства одиночества. Собака в самом деле не любит оставаться одна.", "author" => "Карел Чапек ");
        $aphorism[] = array("content" => "Для своей собаки каждый из нас - Наполеон; вот почему так любят собак. ", "author" => "Олдос Хаксли ");
        $aphorism[] = array("content" => "Если бы собаки научились говорить, мы лишились бы последнего друга. ", "author" => "Данил Рудый ");
        $aphorism[] = array("content" => "Если бы собаки умели говорить, они бы не казались такими умными. ", "author" => "Сергей Савватеев ");
        $aphorism[] = array("content" => "Если Ваш друг верен Вам не взирая на обстоятельства то ставлю 100 против одного что это Ваша собака ");
        $aphorism[] = array("content" => "Если вы подберете на улице дворовую собаку и накормите её, она никогда вас не укусит. В этом и состоит разница между собакой и человеком. ", "author" => "Марк Твен ");
        $aphorism[] = array("content" => "Каждая собака должна иметь свою косточку. ", "author" => "Би Дорси Орли ");
        $aphorism[] = array("content" => "Нет собаки - заведи друга. ", "author" => "Геннадий Малкин ");
        $aphorism[] = array("content" => "Ни одно домашнее животное не прыгнет на стул во время обеда, если оно не абсолютно уверено, что может внести свою лепту в разговор. ", "author" => "Фран Лебовиц ");
        $aphorism[] = array("content" => "Собак любят за то, что они не хотят стать хозяевами. ", "author" => "Геннадий Малкин ");
        $aphorism[] = array("content" => "Собак мы любим настолько, насколько они похожи на нас, и не любим настолько, насколько мы похожи на них. ", "author" => "Ишхан Геворгян ");
        $aphorism[] = array("content" => "Собака прыгает к вам на колени, потому что любит вас; кошка - потому что ей так теплее. ", "author" => "Альфред Норт Уайтхед ");
        $aphorism[] = array("content" => "Собака, что лает на расстоянии, не укусит никогда. ", "author" => "Томас Фуллер ");
        $aphorism[] = array("content" => "Собаки и кошки своей нетребовательной дружбой нам помогают преодолеть страх возможного одиночества и дают возможность удовлетворить нашу потребность 
быть добрым. ", "author" => "Ишхан Геворгян ");
        $aphorism[] = array("content" => "Собаки тоже смеются, только они смеются хвостом. ", "author" => "Макс Истман ");
        $aphorism[] = array("content" => "Те, кто содержит животных, должны признать, что скорее они служат животным, чем животные им. ", "author" => "Мишель Монтень ");
        $aphorism[] = array("content" => "Только человек, у которого есть собака, чувствует себя человеком. ", "author" => "Пшекруй ");
        $aphorism[] = array("content" => "Купи собаку. Это единственный способ купить любовь за деньги. 
", "author" => "Янина Ипохорская ");
        $aphorism[] = array("content" => "Собака так преданна, что даже не веришь в то, что человек заслуживает такой любви.", "author" => "Илья Ильф ");
        $aphorism[] = array("content" => "Хорошему человеку бывает стыдно даже перед собакой.", "author" => "Антон Чехов ");
        $aphorism[] = array("content" => "Чем больше я узнаю людей, тем больше люблю собак.", "author" => "Жан-Мари Ролан");
        $aphorism[] = array("content" => "Собака есть единственное животное, верность которого непоколебима. 
", "author" => "Ж. Бюффон");
        $aphorism[] = array("content" => "Собака - единственное существо, воочию видевшее своего Бога!");
        $aphorism[] = array("content" => "У собак лишь один недостаток - они верят людям.", "author" => "
Элиан Дж. Финберт");
        $aphorism[] = array("content" => "Никто не поймет до конца, что такое любовь, пока не заведет собаку", "author" => "Джен Хилл");
        $aphorism[] = array("content" => "Собака была создана специально для детей: она – бог радости", "author" => "Генри Уард Бичер");
        $aphorism[] = array("content" => "Счастье – это теплый щенок", "author" => "Чарльз М. Шульц");
        $aphorism[] = array("content" => "Собаки никогда не врут о любви", "author" => "Джефри Мозеф Массон");
        $aphorism[] = array("content" => "Никто не ценит гениальности ваших слов так, как собака", "author" => "Кристофер Морли");
        $aphorism[] = array("content" => "Интересно, думают ли другие собаки, что пудели – это члены какой-то странной секты?", "author" => "Рита Руднер");
        $aphorism[] = array("content" => "Если вы привыкли думать о том, какая вы влиятельная особа, попробуйте приказать чужой собаке подойти", "author" => "Вилл Роджерс");
        $aphorism[] = array("content" => "В рай попадают по блату. Если бы туда попадали по заслугам, то вместо тебя туда бы попала твоя собака", "author" => "Марк Твен");
        $aphorism[] = array("content" => "Если собака не подойдет к вам после того, как взглянула вам в лицо, идите домой и проверьте свою совесть", "author" => "Вудро Уилсон");
        $aphorism[] = array("content" => "У собаки очень редко получается повысить человека до своего уровня благоразумия. Но человек зачастую опускает собаку до своего", "author" => "Джеймс Тербер");
        $rand = mt_rand(0, count($aphorism)-1);
        return $aphorism[$rand];
    }
}