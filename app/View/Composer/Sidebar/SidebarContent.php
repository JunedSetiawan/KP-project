<?php

namespace App\View\Composer\Sidebar;


class SidebarContent
{

    public static function hasActiveChild($menus)
    {
        foreach ($menus as $menu) {
            if (request()->routeIs($menu['route']) || (isset($menu['menus']) && static::hasActiveChild($menu['menus']))) {
                return true;
            }
        }
        return false;
    }

    public static function dashboard()
    {
        return [
            [
                'title' => 'Dashboard',
                'permissions' => '',
                'menus' => [
                    [
                        'title' => 'Dashboard',
                        'route' => 'dashboard',
                        'permissions' => '',
                        'icon' => @svg('heroicon-o-home'),
                        'menus' => [],
                    ],
                ],
            ],
            [
                'title' => 'Documentation',
                'permissions' => '',
                'menus' => [
                    [
                        'title' => 'Siswa',
                        'route' => 'student.index',
                        'icon' => @svg('heroicon-o-user'),
                        'permissions' => '',
                        'menus' => [],
                    ],
                    [
                        'title' => 'Guru',
                        'route' => 'teacher.index',
                        'icon' => @svg('heroicon-o-academic-cap'),
                        'permissions' => '',
                        'menus' => [],
                    ],
                    [
                        'title' => 'Kelas',
                        'route' => 'classes.index',
                        'icon' => @svg('heroicon-o-home-modern'),
                        'permissions' => '',
                        'menus' => [],
                    ],
                    [
                        'title' => 'Tahun Sekolah',
                        'route' => 'schoolyear.index',
                        'icon' => @svg('heroicon-o-calendar-days'),
                        'permissions' => '',
                        'menus' => [],
                    ],
                    [
                        'title' => 'User',
                        'route' => 'user.index',
                        'icon' => @svg('heroicon-o-user-group'),
                        'permissions' => 'manage-user',
                        'menus' => [],
                    ],
                    [
                        'title' => 'Daftar Hadir',
                        'route' => 'attendance.index',
                        'icon' => @svg('heroicon-o-clipboard-document-check'),
                        'menus' => [],
                    ],
                    [
                        'title' => 'Riwayat Data Kelas',
                        'route' => 'studentclasshistory.index',
                        'icon' => @svg('heroicon-o-clipboard-document'),
                        'menus' => [],
                    ],
                    [
                        'title' => 'Riwayat Daftar Hadir',
                        'route' => 'logattendance.index',
                        'icon' => @svg('heroicon-o-clipboard-document-list'),
                        'menus' => [],
                    ],

                ],
            ]
        ];
    }
}
