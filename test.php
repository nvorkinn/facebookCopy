<html>
<head>
  	
	<?PHP 
        
            require_once("includes/php-includes.php"); ?>	
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.tokeninput.js"></script>

    <link rel="stylesheet" href="css/token-input.css" type="text/css" />
    <link rel="stylesheet" href="css/token-input-facebook.css" type="text/css" />

    <script type="text/javascript">
    $(document).ready(function() {
        $("input[type=button]").click(function () {
            alert("Would submit: " + $(this).siblings("input[type=text]").val());
        });
    });
    </script>

</head>

<body>
    <h1>jQuery Tokeninput Demos</h1>

    <h2>Simple Server-Backed Search</h2>
    <div>
        <input type="text" id="demo-input" name="blah" />
        <input type="button" value="Submit" />
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php");
        });
        </script>
    </div>


    <h2>Simple Local Data Search</h2>
    <div>
        <input type="text" id="demo-input-local" name="blah" />
        <input type="button" value="Submit" />
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-local").tokenInput([
                {id: 7, name: "Ruby"},
                {id: 11, name: "Python"},
                {id: 13, name: "JavaScript"},
                {id: 17, name: "ActionScript"},
                {id: 19, name: "Scheme"},
                {id: 23, name: "Lisp"},
                {id: 29, name: "C#"},
                {id: 31, name: "Fortran"},
                {id: 37, name: "Visual Basic"},
                {id: 41, name: "C"},
                {id: 43, name: "C++"},
                {id: 47, name: "Java"}
            ]);
        });
        </script>
    </div>


    <h2 id="theme">Facebook Theme</h2>
    <div>
        <input type="text" id="demo-input-facebook-theme" name="blah2" />
        <input type="button" value="Submit" />
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-facebook-theme").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
                theme: "facebook"
            });
        });
        </script>
    </div>


    <h2 id="custom-labels">Custom Labels</h2>
    <div>
        <input type="text" id="demo-input-custom-labels" name="blah" />
        <input type="button" value="Submit" />
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-custom-labels").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
                hintText: "I can has tv shows?",
                noResultsText: "O noes",
                searchingText: "Meowing..."
            });
        });
        </script>
    </div>


    <h2 id="custom-delete">Custom Delete Icon</h2>
    <div>
        <input type="text" id="demo-input-custom-delete" name="blah" />
        <input type="button" value="Submit" />
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-custom-delete").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
                deleteText: "&#x2603;"
            });
        });
        </script>
    </div>


    <h2 id="custom-limits">Custom Search Delay, Search Limit &amp; Token Limit</h2>
    <div>
        <input type="text" id="demo-input-custom-limits" name="blah" />
        <input type="button" value="Submit" />
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-custom-limits").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
                searchDelay: 2000,
                minChars: 4,
                tokenLimit: 3
            });
        });
        </script>
    </div>


    <h2 id="prevent-custom-delimiter">Custom Token Delimiter</h2>
    <div>
        <input type="text" id="demo-input-custom-delimiter" name="blah" />
        <input type="button" value="Submit" />
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-custom-delimiter").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
                tokenDelimiter: "|"
            });
        });
        </script>
    </div>


    <h2 id="prevent-duplicates">No Duplicates</h2>
    <div>
        <input type="text" id="demo-input-prevent-duplicates" name="blah" />
        <input type="button" value="Submit" />
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-prevent-duplicates").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
                preventDuplicates: true
            });
        });
        </script>
    </div>


    <h2 id="pre-populated">Pre-populated</h2>
    <div>
        <input type="text" id="demo-input-pre-populated" name="blah" />
        <input type="button" value="Submit" />
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-pre-populated").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
                prePopulate: [
                    {id: 123, name: "Slurms MacKenzie"},
                    {id: 555, name: "Bob Hoskins"},
                    {id: 9000, name: "Kriss Akabusi"}
                ]
            });
        });
        </script>
    </div>


    <h2 id="pre-populated-with-tokenlimit">Pre-populated &amp; Token Limit</h2>
    <div>
        <input type="text" id="demo-input-pre-populated-with-tokenlimit" name="blah" />
        <input type="button" value="Submit" />
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-pre-populated-with-tokenlimit").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
                prePopulate: [
                    {id: 123, name: "Slurms MacKenzie"},
                    {id: 555, name: "Bob Hoskins"},
                    {id: 9000, name: "Kriss Akabusi"}
                ],
                tokenLimit: 3
            });
        });
        </script>
    </div>


    <h2 id="disable-animation">Disable Animation on Dropdown</h2>
    <div>
        <input type="text" id="demo-input-disable-animation" name="blah" />
        <input type="button" value="Submit" />
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-disable-animation").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
                animateDropdown: false
            });
        });
        </script>
    </div>


    <h2 id="onresult">Modify Response with onResult Callback</h2>
    <div>
        <input type="text" id="demo-input-onresult" name="blah" />
        <input type="button" value="Submit" />
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-onresult").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
                onResult: function (results) {
                    $.each(results, function (index, value) {
                        value.name = "OMG: " + value.name;
                    });

                    return results;
                }
            });
        });
        </script>
    </div>


    <h2 id="onadd-ondelete">Using onAdd and onDelete Callbacks</h2>
    <div>
        <input type="text" id="demo-input-onadd-ondelete" name="blah" />
        <input type="button" value="Submit" />
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-onadd-ondelete").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
                onAdd: function (item) {
                    alert("Added " + item.name);
                },
                onDelete: function (item) {
                    alert("Deleted " + item.name);
                }
            });
        });
        </script>
    </div>


    <h2 id="plugin-methods">Using the add, remove and clear Methods</h2>
    <div>
        <a href="#" id="plugin-methods-add">Add Token</a> | <a href="#" id="plugin-methods-remove">Remove Token</a> | <a href="#" id="plugin-methods-clear">Clear Tokens</a><br />
        <input type="text" id="demo-input-plugin-methods" name="blah" />
        <input type="button" value="Submit" />
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-plugin-methods").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php");

            // Add a token programatically
            $("#plugin-methods-add").click(function () {
                $("#demo-input-plugin-methods").tokenInput("add", {id: 999, name: "James was here"});
                return false;
            });

            // Remove a token programatically
            $("#plugin-methods-remove").click(function () {
                $("#demo-input-plugin-methods").tokenInput("remove", {name: "James was here"});
                return false;
            });

            // Clear all tokens
            $("#plugin-methods-clear").click(function () {
                $("#demo-input-plugin-methods").tokenInput("clear");
                return false;
            });
        });
        </script>
    </div>
    
    <h2>Local Data Search with custom propertyToSearch, resultsFormatter and tokenFormatter</h2>
    <div>
        <input type="text" id="demo-input-local-custom-formatters" name="blah" />
        <input type="button" value="Submit" />
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-local-custom-formatters").tokenInput([{
                "first_name": "Arthur",
                "last_name": "Godfrey",
                "email": "arthur_godfrey@nccu.edu",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Adam",
                "last_name": "Johnson",
                "email": "wravo@yahoo.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Jeff",
                "last_name": "Johnson",
                "email": "bballnine@hotmail.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Adriana",
                "last_name": "Jameson",
                "email": "adriana.jameson@gmail.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Adriano",
                "last_name": "Pooley",
                "email": "adrianolpooley@lautau.com.br",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Alcir",
                "last_name": "Reis",
                "email": "alcirreis@yahoo.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Jack",
                "last_name": "Cunningham",
                "email": "jcunningham@hotmail.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Alejandro",
                "last_name": "Forbes",
                "email": "alejandforbes@gmail.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Alessandra",
                "last_name": "Mineiro",
                "email": "alc_mineiro@aol.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Alex",
                "last_name": "Frazo",
                "email": "alex.frazo@yahoo.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Alexandre",
                "last_name": "Crawford",
                "email": "xandycrawford@gmail.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Alexandre",
                "last_name": "Lalwani",
                "email": "alexandrelalwani@globo.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Alexandre",
                "last_name": "Jokos",
                "email": "alex.jokos@gmail.com.br",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Alexandre",
                "last_name": "Paro",
                "email": "alexandre.paro@uol.com.br",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Andre",
                "last_name": "Niemeyer",
                "email": "a.niemeyer@globo.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Alyssa",
                "last_name": "Fortes",
                "email": "afort287@yahoo.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Amit",
                "last_name": "Alvarenga",
                "email": "amit.alva@gmail.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Ana Bia",
                "last_name": "Borges",
                "email": "abborges@gmail.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Ana",
                "last_name": "Akamine",
                "email": "ana.akamine@uol.com.br",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Anderson",
                "last_name": "Tovoros",
                "email": "alvarenga.tovoros@gmail.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Andre",
                "last_name": "Borges",
                "email": "andreborges@hotmail.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Andre",
                "last_name": "Wexler",
                "email": "andre.wexler@aol.com.br",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Andre",
                "last_name": "Williams",
                "email": "awilly@yahoo.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Andre",
                "last_name": "Sanford",
                "email": "andre.sanford@gmail.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Andre",
                "last_name": "Wayne",
                "email": "andrewayne@uol.com.br",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Andre",
                "last_name": "Jackson",
                "email": "andre.jackson@yahoo.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Andre",
                "last_name": "Jolly",
                "email": "andre.jolly@uol.com.br",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            },
            {
                "first_name": "Andre",
                "last_name": "Henderson",
                "email": "andre.henderson@globo.com",
                "url": "https://si0.twimg.com/sticky/default_profile_images/default_profile_2_normal.png"
            }
          ], {
              propertyToSearch: "first_name",
              resultsFormatter: function(item){ return "<li>" + "<img src='" + item.url + "' title='" + item.first_name + " " + item.last_name + "' height='25px' width='25px' />" + "<div style='display: inline-block; padding-left: 10px;'><div class='full_name'>" + item.first_name + " " + item.last_name + "</div><div class='email'>" + item.email + "</div></div></li>" },
              tokenFormatter: function(item) { return "<li><p>" + item.first_name + " " + item.last_name + "</p></li>" },
          });
        });
        </script>
    </div>
</body>
</html>