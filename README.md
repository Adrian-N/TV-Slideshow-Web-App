# TV Slideshow Web App
TV Slideshow for offices. Display image slides on office TVs via a build-in web browser.

## Features

* Slideshow settings such us timing via URL.
* Ability to upload different slides for individual department or team. 
* Optional shared slides between all departments.
* Automatic refresh (for updating slides).

## Demo
[adriannowak.net/prod/tv_slideshow/](https://www.adriannowak.net/prod/tv_slideshow/b.php?general=YES&dep=NONE&time=10&reset=30&speed=800)
Press F11 for full screen.


## Getting Started

### Prerequisites

- Web server with PHP.
- Full HD SmartTV with internet and web browser, full-screen feature is recommended.
- Full HD Slides in JPG or PNG, e.g. exported via PowerPoint.

### Deployment

1. Copy files to web server
2. Use "shared" folder to upload shared slides between departments
or
3. Create different folders for each department. For example create "HR" folder for HR department and upload slides for HR.
5. Make sure firewall is open as b.php needs to access jquery.

* Optional - Hide PHP errors for Prod. Line 3-5 in b.php
* Optional - Style scripts/error.jpg to match your company theme.

### Running

Run slideshow with following URL:

<domain>/b.php

Use following parameters for settings and to set department:

* shared=YES (Shared Slides YES or NO)
* dep=HR (Department Name - same as album folder name)
* time=20 (Time per slide in seconds)
* reset=30 (Slides refresh in minutes)
* speed=800 (speed of the transition)

URL Example:

**www.domain.com/b.php?shared=YES&dep=HR&time=10&reset=30&speed=800**

## Security
Hackers love to hack into office-based TVs and mess with the slideshows. For TV Slideshow Web App it is recommended to use it on internal (LAN) network and restrict IPs it can be accessed from. It was NOT design to be open to the world wide web.

## Built With
 [Maximage](http://www.aaronvanderzwan.com/maximage/) - Slideshow JavaScript Engine

## License
[NPOSL-3.0](https://opensource.org/licenses/NPOSL-3.0) - Non-Profit Open Software License

## By
[adriannowak.net/](https://www.adriannowak.net/)

