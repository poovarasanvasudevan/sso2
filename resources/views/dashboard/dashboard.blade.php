@extends('component.layout')

@section('body')

    <div ng-controller="dashboard" style="margin-top: 70px;">


        @include('component.sidebar')

        <div class="ml+++ pl+++">

            <div class="m" flex-container="row" flex-column="[[artefacttypes.length]]">
                <div ng-repeat="x in artefacttypes">
                    <div class="card m" flex-item="1">
                        <div class="p+">
                            <strong class="fs-headline display-block">[[x.artefact_type_description]]</strong>
                            <span class="fs-subhead tc-black-2 display-block">Contains all [[x.artefact_type_description]]</span>

                            <div class="paragraph fs-body-1 mt+">
                                <p>
                                    [[x.artefact_type_long_description]]
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
    @include('component.toolbar')
@stop