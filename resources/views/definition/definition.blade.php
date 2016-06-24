@extends('component.layout')

@section('body')

    <div ng-controller="definition" style="margin-top: 75px;">
        @include('component.sidebar')

        <div class="ml+++ pl+++">
            <div class="card" flex-container="row" flex-column="12">
                <div flex-item="2"></div>
                <div flex-item="2" class="ml+++">
                    <lx-select ng-model="definition.location"
                               lx-allow-clear="galse"
                               lx-choices="definition.alllocaction"
                               lx-display-filter="false"
                               lx-fixed-label="false"
                               lx-label="Location">
                        <lx-select-selected>
                            [[ $selected.archive_location_desc ]]
                        </lx-select-selected>

                        <lx-select-choices>
                            [[ $choice.archive_location_desc ]]
                        </lx-select-choices>
                    </lx-select>

                </div>

                <div flex-item="2" class="ml+++">
                    <lx-select ng-model="definition.artefacttype"
                               lx-allow-clear="galse"
                               lx-choices="definition.allartefacttypes"
                               lx-display-filter="false"
                               lx-fixed-label="false"
                               lx-label="Artefact Types">
                        <lx-select-selected>
                            [[ $selected.artefact_type_description ]]
                        </lx-select-selected>

                        <lx-select-choices>
                            [[ $choice.artefact_type_description ]]
                        </lx-select-choices>
                    </lx-select>

                </div>

                <div flex-item="2" class="ml+++ mt+">
                    <center>
                        <lx-button lx-color="{{env('THEME')}}" ng-click="search()">Search</lx-button>
                        <lx-button lx-color="red">Reset</lx-button>
                    </center>
                </div>
            </div>
            <div class="m" flex-container="row" flex-column="12">
                <div flex-item="2">

                </div>

                <div flex-item="10">

                </div>
                <lx-progress lx-color="{{env('THEME')}}" lx-type="circular" lx-diameter="150" ng-if="definition.showprogress" class="center"></lx-progress>

            </div>
        </div>
    </div>
    @include('component.toolbar')
@stop