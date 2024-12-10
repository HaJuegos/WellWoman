<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SettingsOptionsService extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        /**
         * Mapeo de todos los elementos que apareceran en el HTML String con sus respectivos artributos autogenerables.
         *
         * La siguiente estructura es esta:
         *
         * labelId - Basicamente como el class del <label>
         * labelTitle - El mensaje dentro del <label>
         * type - El tipo de input de esta configuracion, solo se puede select y checkbox.
         *
         * En caso de poner en type, select, se agrega esto:
         * selectNameId - Lo mismo de labelId pero ahora solo ahora es para el artributo name="" de <select>
         * selectId - Lo mismo de labelId pero ahora solo ahora es para el artributo id="" de <select>
         *
         * Como en esta estructura se agrega un for para los valores que se pueden seleccionar en cada opcion. Hay dos variantes de for, uno normal que recorre i++ y otro que es custom que es para que i aumente por el numero x que quieras. En este caso:
         *
         * isNormalRange - Si este es verdadero, entonces sera un for normal usando un recorrido i++. En caso contrario de no usarse, dejarlo en false.
         * normalRangeI - Si es true lo de arriba, entonces este es el valor de i en el for.
         * normalRangeIMax - Si es true lo de arriba, entonces este es el valor de i <=, para medir hasta donde tiene que terminar.
         *
         * En caso de que isNormalRange sea false, entonces no agregar normalRangeI y demas.
         *
         * isCustomRange - Si este es verdadero, entonces sera un for custom con un recorido diferente a i++. No puede ser false o marcara error.
         * customRangeI - Si es true lo de arriba, entonces este es el valor de i en el for.
         * customRangeIMax - Si es true lo de arriba, entonces es el valor de i <=, para medir hasta donde tiene que terminar.
         * customRangeIPlus - Si es true lo de arriba, entonces este es el valor de i += para saber como aumentara i por cada recorrido.
         *
         * En caso de que isNormalRange sea true, no agregar lo de customRange y demas.
         *
         * optionalOptionValue - Valor opcional que se puede dejar asi ''. Es para que cada valor de la lista de seleccion tenga un texto a su lado, poner espacio antes, de esta forma: ' '.
         *
         * En caso de poner en type, checkbox, se agrega esto:
         * checkboxName - El name="" del checkbox en html.
         * checkboxId - El id="" del checkbox en html.
         *
         * infoText - Texto adiccional que aparece abajo del titulo de la lista para informar la categoria en especifico.
         *
         * @var array
         */
        $configMap = [
            [
                'labelId' => 'Ultimo Periodo',
                'labelTitle' => 'Ingresa la fecha de tu ultimo periodo:',
                'type' => 'date',
                'dayTimeName' => 'lastPeriod'
            ],
            [
                'labelId' => 'duracion-ciclo',
                'labelTitle' => 'Duracion del Ciclo (Dias):',
                'type' => 'select',
                'selectNameId' => 'cycle_duration',
                'selectId' => 'ciclo-selects',
                'isNormalRange' => true,

                'normalRangeI' => 20,
                'normalRangeIMax' => 40,
                'optionalOptionValue' => '',
            ],
            [
                'labelId' => 'duracion-regla',
                'labelTitle' => 'Duracion del Periodo (dias):',
                'type' => 'select',
                'selectNameId' => 'period_duration',
                'selectId' => 'regla-selects',
                'isNormalRange' => true,

                'normalRangeI' => 2,
                'normalRangeIMax' => 12,
                'optionalOptionValue' => '',

                'infoText' => 'Se hacen pronósticos basados en los ajustes de duración del ciclo y
                        menstruación.'
            ],
            [
                'labelId' => 'pregnant-input',
                'labelTitle' => 'Probabilidad de embarazo:',
                'type' => 'checkbox',
                'checkboxName' => 'pregnancy_probability',
                'checkboxId' => 'pregnant-input',

                'infoText' => 'Si está desactivado, solo se mostrará el día de ovulación.'
            ],
            [
                'labelId' => 'lutea-selector',
                'labelTitle' => 'Fase lútea (días):',
                'type' => 'select',
                'selectNameId' => 'luteal_phase',
                'selectId' => 'lutea-selects',
                'isNormalRange' => true,

                'normalRangeI' => 8,
                'normalRangeIMax' => 17,
                'optionalOptionValue' => '',

                'infoText' => 'Tiempo entre ovulación y comienzo del periodo.'
            ],
            [
                'labelId' => 'sleep-selector',
                'labelTitle' => 'Tiempo normal de sueño (horas):',
                'type' => 'select',
                'selectNameId' => 'sleep_hours',
                'selectId' => 'sleep-selects',
                'isNormalRange' => true,

                'normalRangeI' => 5,
                'normalRangeIMax' => 12,
                'optionalOptionValue' => ' h',

                'infoText' => 'Elige el tiempo promedio que duermes cada noche.'
            ],
            [
                'labelId' => 'water-selector',
                'labelTitle' => 'Consumo normal de agua (litros):',
                'type' => 'select',
                'selectNameId' => 'water_intake',
                'selectId' => 'water-selects',
                'isNormalRange' => false,
                'isCustomRange' => true,

                'customRangeI' => 1,
                'customRangeIMax' => 5,
                'customRangeIPlus' => 0.25,

                'optionalOptionValue' => ' L',

                'infoText' => 'Litros promedio consumidos al día.'
            ],
            [
                'labelId' => 'steps-selector',
                'labelTitle' => 'Objetivo diario de pasos:',
                'type' => 'select',
                'selectNameId' => 'step_goal',
                'selectId' => 'steps-selects',
                'isNormalRange' => false,
                'isCustomRange' => true,

                'customRangeI' => 5000,
                'customRangeIMax' => 9500,
                'customRangeIPlus' => 500,

                'optionalOptionValue' => '',

                'infoText' => 'Cantidad de pasos diarios a alcanzar.'
            ],
            [
                'labelId' => 'weight-selector',
                'labelTitle' => 'Peso deseado (kg):',
                'type' => 'select',
                'selectNameId' => 'desired_weight',
                'selectId' => 'weight-selects',
                'isNormalRange' => true,

                'normalRangeI' => 50,
                'normalRangeIMax' => 100,

                'optionalOptionValue' => ''
            ],
            [
                'labelId' => 'height-selector',
                'labelTitle' => 'Altura (cm):',
                'type' => 'select',
                'selectNameId' => 'desired_height',
                'selectId' => 'height-selects',
                'isNormalRange' => true,

                'normalRangeI' => 90,
                'normalRangeIMax' => 250,

                'optionalOptionValue' => ' cm',

                'infoText' => 'Tu altura en centímetros.'
            ],
            [
                'labelId' => 'calories-selector',
                'labelTitle' => 'Objetivo diario de pasos:',
                'type' => 'select',
                'selectNameId' => 'calorie_intake',
                'selectId' => 'calories-selects',
                'isNormalRange' => false,
                'isCustomRange' => true,

                'customRangeI' => 1000,
                'customRangeIMax' => 5000,
                'customRangeIPlus' => 100,

                'optionalOptionValue' => ' Cal',

                'infoText' => 'Calorías promedio consumidas al día.'
            ]
        ];

        $cycleOptionsHtml = $this->cycleOptions($configMap);

        View::share('cycleOptionsHtml', $cycleOptionsHtml);
    }

    /**
     * Esta funcion genera un bloque de HTML dinamico con diversos parametros de un array.
     * @param array $configs Una lista de arreglos con los parametros para genera los bloques deseados en el html.
     * @return string El bloque en cuestion del HTML.
     */
    public function cycleOptions($configs)
    {
        $html = '';

        foreach ($configs as $config) {
            $html .= '<div class="config-group">';

            $html .= '<div class="config-selector">';
            $html .= '<label for="' . $config['labelId'] . '">' . $config['labelTitle'] . '</label>';

            if ($config['type'] == 'select') {
                $html .= '<select name="' . $config['selectNameId'] . '" id="' . $config['selectId'] . '" data-key="' . $config['labelId'] . '">';
                $html .= '<option value="-1">Seleccionar</option>';

                if ($config['isNormalRange']) {
                    for ($i = $config['normalRangeI']; $i <= $config['normalRangeIMax']; $i++) {
                        $html .= '<option value="' . $i . '">' . $i . $config['optionalOptionValue'] . '</option>';
                    }
                } else if ($config['isCustomRange']) {
                    for ($i = $config['customRangeI']; $i <= $config['customRangeIMax']; $i += $config['customRangeIPlus']) {
                        $html .= '<option value="' . $i . '">' . $i . $config['optionalOptionValue'] . '</option>';
                    }
                }

                $html .= '</select>';
            }

            if ($config['type'] == 'checkbox') {
                $html .= '<div class="checkbox-wrapper-7">';
                $html .= '<input class="tgl tgl-ios" type="checkbox" name="' . $config['checkboxName'] . '" id="' . $config['checkboxId'] . '" data-key="' . $config['labelId'] . '">';
                $html .= '<label class="tgl-btn" for="' . $config['checkboxId'] . '"></label>';
                $html .= '</div>';
            }

            if ($config['type'] == 'date') {
                $html .= '<div class="input-date-container">';
                $html .= ' <input type="date" name="' . $config['dayTimeName'] . '" id="' . $config['dayTimeName'] . '">';
                $html .= '</div>';
            }

            $html .= '</div>';

            if (isset($config['infoText'])) {
                $html .= '<div class="config-help">';
                $html .= '<p class="config-helper">' . $config['infoText'] . '</p>';
                $html .= '</div>';
            }

            $html .= '</div>';
        }

        return $html;
    }
}
