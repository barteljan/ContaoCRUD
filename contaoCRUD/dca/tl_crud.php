<?php

$GLOBALS['TL_DCA']['tl_crud'] = array
(
    // Config
    'config' => array
    (
        'dataContainer' => 'Table',
        'enableVersioning' => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary'
            )
        ),
    ),
    'list' => array
    (
        'sorting' => array
        (
            'mode' => 2,
            'fields' => array('alias'),
            'flag' => 1,
            'panelLayout' => 'filter;sort,search,limit'
        ),
        'label' => array
        (
            'fields' => array('alias'),
            'format' => '%s',
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_crud']['edit'],
                'href' => 'act=edit',
                'icon' => 'edit.gif'
            ),
            'delete' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_crud']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_crud']['show'],
                'href' => 'act=show',
                'icon' => 'show.gif',
                'attributes' => 'style="margin-right:3px"'
            ),
        )
    ),// Palettes
    'palettes' => array
    (
        'default' => 'alias,{table_configuration},crudTable,palettes'
    ),
    'fields' => array
    (
        'id' => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'alias' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_crud']['alias'],
            'inputType' => 'text',
            'exclude' => true,
            'sorting' => true,
            'flag' => 1,
            'search' => true,
            'eval' => array(
                'mandatory' => true,
                'unique' => true,
                'maxlength' => 255,
                'tl_class' => 'w50',

            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),
        'crudTable' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_crud']['crudTable'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'select',
            'options_callback'        => array('tl_form', 'getAllTables'),
            'eval'                    => array('mandatory' => true,'submitOnChange'=>true,'chosen'=>false,'tl_class'=>'w50'),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'palettes' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_crud']['palettes'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'select',
            'options_callback'        => array('jba\contaoCRUD\CRUDBackendProcessor', 'getAllPalettes'),
            'eval'                    => array('mandatory' => false,'submitOnChange'=>true,'chosen'=>true,'tl_class'=>'w50'),
            'sql'                     => "varchar(64) NOT NULL default ''"
        )
    )
);