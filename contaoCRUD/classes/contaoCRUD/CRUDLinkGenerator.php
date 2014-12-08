<?php
/**
 * Created by PhpStorm.
 * User: bartel
 * Date: 01.12.14
 * Time: 19:37
 */

namespace jba\contaoCRUD;

use Bit3\Contao\ThemePlus\DataContainer\Page;
use Contao\PageModel;

class CRUDLinkGenerator extends \Controller
{
    /**
     * Object instance (Singleton)
     * @var \jba\contaoCRUD\LinkGenerator
     */
    protected static $objInstance;

    /**
     * @return \jba\contaoCRUD\LinkGenerator
     */
    public static function getInstance()
    {
        if (static::$objInstance === null) {
            static::$objInstance = new static();
            static::$objInstance->initialize();
        }

        return static::$objInstance;
    }

    protected $editLinkTemplate = "crud_edit_link";

    /**
     * @return string
     */
    public function getEditLinkTemplate()
    {
        return $this->editLinkTemplate;
    }

    /**
     * @param string $editLinkTemplate
     */
    public function setEditLinkTemplate($editLinkTemplate)
    {
        $this->editLinkTemplate = $editLinkTemplate;
    }


    public function initialize()
    {
        $this->import("FrontendUser", "frontendUser");
        $this->import("Session", "session");
        $this->import("PageModel", "pageModel");
    }

    /**
     * @return string
     */
    public function getEditLinkUrl($itemIdOrAlias, $itemGetParam, $allowedGroups, $editPageIdOrAlias)
    {

        $userGroups = $this->frontendUser->groups;

        $currentPageId = $this->replaceInsertTags('{{page::id}}');
        $this->session->set("jumpToPageId", $currentPageId);

        $allowed = false;

        if (is_array($userGroups) && is_array($allowedGroups)) {
            foreach ($userGroups as $userGroup) {
                if (in_array($userGroup, $allowedGroups)) {
                    $allowed = true;
                }
            }
        }

        if ($allowed) {
            $editPage = PageModel::findByIdOrAlias($editPageIdOrAlias);
            if ($editPage) {
                return $editPage->alias . ".html?" . $itemGetParam . "=" . urlencode($itemIdOrAlias);
            }
        }

        return '';
    }


    public function getEditLink($itemIdOrAlias, $itemGetParam, $allowedGroups, $editPageIdOrAlias){

        $template = new \FrontendTemplate($this->getEditLinkTemplate());
        $link = $this->getEditLinkUrl($itemIdOrAlias, $itemGetParam, $allowedGroups, $editPageIdOrAlias);
        $template->link = $link;
        return $template->parse();

    }




} 