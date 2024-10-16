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
                'title' => 'Data Master',
                'permissions' => 'manage-student',
                'menus' => [
                    [
                        'title' => 'Data Master',
                        'route' => null,
                        'icon' => @svg('heroicon-o-academic-cap'),
                        'permissions' => 'manage-student',
                        'menus' => [
                            [
                                'title' => 'Siswa',
                                'route' => 'student.index',
                                'permissions' => '',
                                'icon' => null
                            ],
                            [
                                'title' => 'Guru',
                                'route' => 'teacher.index',
                                'permissions' => '',
                                'icon' => null
                            ],
                            [
                                'title' => 'Kelas',
                                'route' => 'classes.index',
                                'permissions' => '',
                                'icon' => null
                            ],
                        ],
                    ],
                ]
                ],
             [
                'title' => 'Fitur',
                'permissions' => 'manage-student',
                'menus' => [
                   
                    [
                        'title' => 'Siswa Lulus',
                        'route' => 'student.graduate',
                        'icon' => @svg('heroicon-o-academic-cap'),
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

                    [
                        'title' => 'Catatan Perkembangan Peserta Didik',
                        'route' => null,
                        'icon' => @svg('heroicon-o-pencil-square'),
                        'permissions' => '',
                        'menus' => [
                            [
                                'title' => 'Prestasi',
                                'route' => 'achievement.index',
                                'permissions' => '',
                                'icon' => null,
                            ],
                            [
                                'title' => 'Pelanggaran',
                                'route' => 'violation.index',
                                'icon' => null,
                            ],
                        ],
                    ],

                ],
            ],
            [
                'title' => 'Layanan',
                'permissions' => '',
                'menus' => [
                    [
                        'title' => 'Layanan',
                        'route' => null,
                        'icon' => @svg('heroicon-o-question-mark-circle'),
                        'permissions' => '',
                        'menus' => [
                            [
                                'title' => 'Layanan Informasi',
                                'route' => 'informationservice.index',
                                'permissions' => 'manage-student',
                                'icon' => null,
                            ],
                            [
                                'title' => 'Layanan Classical',
                                'route' => 'material.index',
                                'icon' => null,
                            ],
                        ],
                    ],
                ]
                ],
        ];
    }
}
