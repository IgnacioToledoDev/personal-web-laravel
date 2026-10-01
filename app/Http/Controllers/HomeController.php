<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Link;
use App\Models\Profile;
use App\Models\Project;
use App\Models\SkillGroup;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $profile = Profile::query()->firstOrFail();

        $site = [
            'user' => $profile->user,
            'host' => $profile->host,
            'path' => $profile->path,
            'ascii' => $profile->ascii,
            'neofetch' => [
                'titleName' => $profile->neofetch_title_name,
                'titleHost' => $profile->neofetch_title_host,
                'rows' => collect($profile->neofetch_rows)
                    ->map(fn ($row) => [$row['label'], $row['value']])
                    ->all(),
            ],
            'about' => [
                'lead' => $profile->about_lead,
                'meta' => collect($profile->about_meta)
                    ->map(fn ($row) => [$row['key'], $row['value'], (bool) $row['isAccent']])
                    ->all(),
            ],
            'projects' => Project::query()->orderBy('sort_order')->get()->map(fn (Project $p) => [
                'name' => $p->name,
                'lang' => $p->lang,
                'color' => $p->color,
                'stars' => $p->stars,
                'desc' => $p->desc,
                'tags' => $p->tags,
                'url' => $p->url,
            ])->all(),
            'skills' => SkillGroup::query()->orderBy('sort_order')->get()->map(fn (SkillGroup $g) => [
                'group' => $g->group,
                'items' => collect($g->items)
                    ->map(fn ($item) => [$item['name'], (int) $item['level'], $item['note'] ?? ''])
                    ->all(),
            ])->all(),
            'experience' => Experience::query()->orderBy('sort_order')->get()->map(fn (Experience $e) => [
                'hash' => $e->hash,
                'role' => $e->role,
                'company' => $e->company,
                'when' => $e->when,
                'what' => $e->what,
                'stack' => $e->stack,
            ])->all(),
            'links' => Link::query()->orderBy('sort_order')->get()->map(fn (Link $l) => [
                $l->label, $l->display, $l->href,
            ])->all(),
        ];

        $role = collect($profile->about_meta)->firstWhere('key', 'Role')['value'] ?? null;

        $seoTitle = $profile->seo_title
            ?? sprintf('%s@%s — %s', $profile->user, $profile->host, $role ?? 'Backend Developer');

        $seoDescription = $profile->seo_description
            ?? Str::limit(strip_tags(str_replace(['**', '<hl>', '</hl>'], '', $profile->about_lead)), 155);

        $sameAs = collect($site['links'])
            ->pluck(2)
            ->filter(fn ($href) => is_string($href) && Str::startsWith($href, ['http://', 'https://']))
            ->values()
            ->all();

        $jsonLd = [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => $profile->neofetch_title_name ?: $profile->user,
            'jobTitle' => $role ?? 'Backend Developer',
            'url' => url('/'),
            'sameAs' => $sameAs,
        ];

        return view('home', [
            'site' => $site,
            'seoTitle' => $seoTitle,
            'seoDescription' => $seoDescription,
            'jsonLd' => $jsonLd,
        ]);
    }
}
