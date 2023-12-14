<?
class PGetBlocksClass
{
    private $id;
    private $xml_id;
    private $arData;

    private $CacheID = 'PGetBLocks_';
    private $CachePath = '/citrus.developer/template/';

    function __construct($id, $xml_id)
    {
        $this->id = $id;
        $this->xml_id = $xml_id;

        // $this->CacheID = $this->CacheID . $xml_id;
        // $obCache = new CPHPCache();
        // if ($obCache->InitCache(86400 * 7, $this->CacheID, $this->CachePath)) {
        //     $arVars = $obCache->GetVars();
        //     $this->arData = $arVars["data"];
        // } elseif ($obCache->StartDataCache()) {
        //     $this->arData = $this->getItems();

        //     $obCache->EndDataCache(
        //         array(
        //             'data' => $this->arData,
        //         )
        //     );
        // }
        $this->arData = $this->getItems();
    }

    private function getItems(): array
    {
        $result = array();
        $entrances = array();
        $houses = array();

        $arFilter = array(
            "IBLOCK_ID" => $this->id,
            "ACTIVE" => "Y",
            "PROPERTY_COMPLEX" => $this->xml_id
        );
        $arSelect = array("ID", "NAME", "PREVIEW_PICTURE", "IBLOCK_ID", "PROPERTY_FLOOR", "PROPERTY_SECTION", "PROPERTY_LAYOUT", "PROPERTY_HOUSE", "PROPERTY_VYGODA");
        $res = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, false, $arSelect);
        while ($ob = $res->GetNext()) {

            // PLAN
            $resPlan = CIBlockElement::GetList(
                array("SORT" => "ASC"),
                array("ID" => $ob["PROPERTY_LAYOUT_VALUE"]),
                false,
                false,
                array("ID", "NAME", "PREVIEW_PICTURE", "IBLOCK_ID", "PROPERTY_COMMON_AREA", "PROPERTY_FLOOR_PLAN", "PROPERTY_POLYGON")
            );
            $obPlan = $resPlan->GetNext();

            // ENTRANCES
            if (!array_key_exists($ob["PROPERTY_SECTION_VALUE"], $entrances)) {
                $resEntrance = CIBlockElement::GetList(
                    array("SORT" => "ASC"),
                    array("ID" => $ob["PROPERTY_SECTION_VALUE"]),
                    false,
                    false,
                    array("ID", "NAME", "IBLOCK_ID", "SORT")
                );
                $obEntrance = $resEntrance->GetNext();

                $entrances[$ob["PROPERTY_SECTION_VALUE"]] = array(
                    "id" => $obEntrance["ID"],
                    "name" => $obEntrance["NAME"],
                    "sort" => $obEntrance["SORT"]
                );
            }

            // HOUSES
            if (!array_key_exists($ob["PROPERTY_HOUSE_VALUE"], $houses)) {
                $resHouse = CIBlockElement::GetList(
                    array("SORT" => "ASC"),
                    array("ID" => $ob["PROPERTY_HOUSE_VALUE"]),
                    false,
                    false,
                    array("ID", "NAME", "IBLOCK_ID", "SORT", "CODE")
                );
                $obHouse = $resHouse->GetNext();

                $houses[$ob["PROPERTY_HOUSE_VALUE"]] = array(
                    "id" => $obHouse["ID"],
                    "name" => $obHouse["NAME"],
                    "sort" => $obHouse["SORT"],
                    "code" => $obHouse["CODE"]
                );
            }


            // RESULT
            $result[] = array(
                "id" => $ob["ID"],
                "vygoda" => number_format($ob["PROPERTY_VYGODA_VALUE"], 0, '', ' '),
                "title" => $ob["NAME"],
                "preview" => ($ob["PREVIEW_PICTURE"]) ? CFile::GetPath($ob["PREVIEW_PICTURE"]) : "",
                "plan" => array(
                    "id" => $obPlan["ID"],
                    "name" => $obPlan["NAME"],
                    "preview" => ($obPlan["PREVIEW_PICTURE"]) ? CFile::GetPath($obPlan["PREVIEW_PICTURE"]) : "",
                    "totalSquare" => $obPlan["PROPERTY_COMMON_AREA_VALUE"],
                    "floorPlan" => ($obPlan["PROPERTY_FLOOR_PLAN_VALUE"]) ? CFile::GetPath($obPlan["PROPERTY_FLOOR_PLAN_VALUE"]) : "",
                    "polygon" => $obPlan["PROPERTY_POLYGON_VALUE"],
                ),
                "floor" => $ob["PROPERTY_FLOOR_VALUE"],
                "entrance" => $entrances[$ob["PROPERTY_SECTION_VALUE"]],
                "house" => $houses[$ob["PROPERTY_HOUSE_VALUE"]]
            );
        }
        return $result;
    }

    public function getResultData()
    {
        return json_encode($this->arData);
    }
}
