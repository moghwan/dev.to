---
published: true
title: "Is linux good enough for everyday programming?"
cover_image: "https://raw.githubusercontent.com/moghwan/dev.to/master/blog-posts/2-programming-in-linux/assets/header.png"
description:
tags: linux, webdev, productivity, discuss
series:
canonical_url:
---

> Disclaimer: I’m writing about my experience with major OS (Windows 10, macOs High/Sierra, Ubuntu/Manjaro) using a Solid State Drive. It has a huge impact in term of speed and it could be different from your own experience.

Hello there. To begin with, this post isn’t about what’s the best OS for everyday programming, it could depend on the stack used, Misc programs and specially YOU, so i’ll try to describe all the good/bad things that happened during my everyday workflows.

But before that I should let you know my programming stack so you won't get confused later. I mainly use: 
1. PHP frameworks and CMS
1. nodejs frameworks for frontend 
1. react native/ionic for mobile dev
1. Photoshop (with CssHat) for HTML Integration, banner for mobile apps.
1. ms office due to my current job.[1]

## Ubuntu (Unity/Gnome):
By the end of 2015 and after a good run with Windows 7 and using Ubuntu just occasionally in virtual machines I thought I would give it a shot with a daily usage so I installed the 15.10 version. back then i was programming in PHP, Java and C# (because of my Software engineering Studies), php and apache had great performances locally, same for java but used a windows 7 VM for Visual Studio, Ms Office and Adobe Photoshop, because all the alternatives (Darkable/Gimp, Open office) weren't at the same levels. I tried but the more you use them the more you notice their weak points such as ease of use, backward compatibility.

I had a good (exactly 2 years) run switching between Unity and Gnome DE (I was the n°1 hater for KDE btw), but over time and even with SSD it felt a kinda slow (I was always stuck with 16.04 LTS) and honestly, I wasn’t fan of the Ubuntu’s PPAs either and then I discovered the Hackintosh community.

## macOs (10.12/10.14)
So after a hell of an installation process I managed to run macOs Sierra smoothly on a laptop that has hardware near to macbook pro late 2012 (HP elitebook 840 G1). Apps installed with one simple drag n’ drop (applies to android studio too). It run the Android Virtual Device smoother than windows 7 and ubuntu with the same laptop, i was very surprised, the memory management, the apps integration and the overall stability was so great. At that time I finished my studies so no more Java or .Net programming, and the adobe/ms office suite was a strong point compared to Linux in general so every program ran natively without the need of any VM, with our beloved Unix cli.

The only drawback I had with mac, or with hackintosh, is the system updates/upgrades it was so painful to do it breaks your system every time, I was backing up the whole bootable system image whenever I attempted to update. Because the Kexts (Kernel extensions or “drivers”) weren’t always backward compatible.

So in the end i was thinking to go back to linux again but not sure which distribution i will stick with again, I wanted a stable distro that i forgot completely about something called upgrades of “big updates”. In the meantime I give Windows 10 another shot after hearing it got better and better in the last years.

And again, after 2 years with no workflow complaints I backed up my hackintosh installation and installed the last build of windows 10.


## Windows 10.
I’ll resume my experience with one line: [“not great, not terrible”](https://youtu.be/Mg5HOnq7zD0?t=5)
Compared, again, to mac os the system was very smooth in every way, snapping windows, switching virtual desktops, programs and files search in the start menu, no problem but! I already missed the unix cli. Yeah I know there’s cmder and other tools. The overall performance was okay but there was some latency when compiling node js apps. My workflow didn’t change. I used Laragon for all my php projects with phpstorm and it was perfect honestly. On the other hand Android Emulator was terrible even with 8gb or ram and ssd, mac os was handling it way better.

In the meantime I played with some linux distros in VMs and made the choice: Manjaro, KDE flavor.

## Manjaro:

“You said you hated KDE right?” well yes but for a cause, one I didn’t want to bring back the Gnome memories i had with Ubuntu and second, I disliked is because its similarity in UI compared to Windows in general, 10 specially then I found how very customizable was and again i’ll resume it with one line: “everything is a widget”. So in term of UI I made my [simple comfortable setup](https://www.reddit.com/r/unixporn/comments/hs64as/). 

Now in term of programs and workflow I still use PhpStorm for my php and nodejs projects, npm and yarn installed globally and surprisingly npm run very fast compared to windows and mac; git already installed, but for my php projects I migrate all of them to docker with docker compose, majority of projects were based on Laravel, Prestashop, Wordpress and old native php apps. I managed to dockerize some of them from scratch, some with Laradock. 

Java/.Net: RIP.

For mobile development there were some struggles during configuring ionic and react native’s first run but done with them quickly, no problem with android studio but the emulator “again” wasn’t that good as mac os, but not that bad like windows. And I discovered a helpful package that cast my connected android device to my screen and it’s shown as a virtual device but a physical one, called [scrcpy](https://github.com/Genymobile/scrcpy) from the genymotion team!

And finally these are just some of the benefits why I picked manjaro:
1. No big breaking updates.
1. A rolling release distro.
1. Fast security patches.
1. The Great Arch User Repository (AUR)
1. Snap and Flatpak support (but why?)
1. Very stable.

But still there are some drawback, linux’s ones in general:
1. Still needing photoshop and lightroom.
1. Ms Office for work purpose (Managed to use Web version since we have ms365 but still miss Excel for heavy use)


## Conclusion:
Finally and personally I’ll stick with linux for these main two reasons: native support for docker (future projects could be deployed with it) and the unix environment similarity to production servers (cli, ssh and packages’ configuration).
I understand many of you will disagree for many things said in the post but [that’s okay!](https://youtu.be/JZ017D_JOPY?t=223) because, finally, we choose what will help us to give the most of us in terms of productivity.

Thank you all for reading the most boring post ever made on Dev.to platform! I would gladly hear from you some of your thoughts and experiences as well. Thanks again! [1]





[1]: edit. added used stack and a conclusion.
