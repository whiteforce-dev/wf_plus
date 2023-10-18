<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MonsterCategoryRoleMapping;
use App\Models\MonsterEducationStream;
use App\Models\MonsterIndustryCategoryMapping;
use App\Models\NaukariUgSpecilization;
use App\Models\NoukriPgSpecialization;
use App\Models\Noukri_functional_role_mappings;


class MonsterController extends Controller
{
    public function getCategoryRole()
    {
        $monster_category_role_mappings = MonsterCategoryRoleMapping::where('category_id', request('monster_category_function_id'))->cursor();
        return view('pages.conditional.category_role', compact('monster_category_role_mappings'));
    }
    public function getMonsterEducationStream()
    {
        $monster_education_streams = MonsterEducationStream::where('level_id', request('monster_education_level_id'))->cursor();
        return view('pages.conditional.monster_education_stream', compact('monster_education_streams'));
    }
    public function getIndustryCategoryFunction()
    {

        $monsterIndustryCategoryMapping = MonsterIndustryCategoryMapping::where('industry_id', request('monster_industry_id'))->cursor();

        return view('pages.conditional.category_function', compact('monsterIndustryCategoryMapping'));
    }
    public function getNoukriugspec()
    {
        $noukri_ugspecializations = NaukariUgSpecilization::where('UG_ID', request('noukri_ug_qualification'))->cursor();
        return view('pages.conditional.noukri_ugspecializations', compact('noukri_ugspecializations'));
    }

    public function getNoukripgspec()
    {
        $noukri_pgspecializations = NoukriPgSpecialization::where('PG_ID', request('noukri_pg_qualification'))->cursor();
        return view('pages.conditional.noukri_pgspecializations', compact('noukri_pgspecializations'));
    }
    public function noukri_functional_role()
    {
        $noukri_functional_roles = Noukri_functional_role_mappings::where('FAREA_ID', request('noukri_FAREA_ID'))->cursor();
        return view('pages.conditional.noukri_functional_role', compact('noukri_functional_roles'));
    }
}
