{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> Главная</a></li>

@if (backpack_user()->role == 'ADMIN')
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> Пользователи</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('affiliate') }}"><i class="nav-icon la la-building"></i> Филиалы</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('affiliate-banner') }}"><i class="nav-icon la la-image"></i> Баннеры филиалов</a></li>
@endif

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('assignment') }}"><i class="nav-icon la la-list-alt"></i> Записи</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('lesson') }}"><i class="nav-icon la la-bicycle"></i> Уроки</a></li>

@if (backpack_user()->role == 'ADMIN' && backpack_user()->id == 1)
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('type') }}"><i class="nav-icon la la-list-ul"></i> Типы уроков</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('city') }}"><i class="nav-icon la la-city"></i> Города</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('address') }}"><i class="nav-icon la la-question"></i> Адреса</a></li>
@endif
