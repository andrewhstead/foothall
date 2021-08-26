<?php

	switch ($table_id) {
		case "people":
			$identifier = "person";
			$list_column = "name";
			$url_column = "file_code";
			break;
		case "matches":
			$identifier = "match";
			$list_column = "file_code";
			$url_column = "file_code";
			break;
		case "hall_teams":
			$identifier = "team";
			$list_column = "title";
			$url_column = "file_code";
			break;
		case "continents":
			$identifier = "continent";
			$list_column = "name";
			$url_column = "id";
			break;
		case "countries":
			$identifier = "country";
			$list_column = "display_name";
			$url_column = "id";
			break;
		case "teams":
			$identifier = "team";
			$list_column = "name";
			$url_column = "id";
			break;
		case "competitions":
			$identifier = "competition";
			$list_column = "name";
			$url_column = "id";
			break;
		case "tournaments":
			$identifier = "tournament";
			$list_column = "name";
			$url_column = "id";
			break;
		case "stories":
			$identifier = "story";
			$list_column = "title";
			$url_column = "id";
			break;
		case "dream_teams":
			$identifier = "dream_team";
			$list_column = "name";
			$url_column = "id";
			break;
		case "polls":
			$identifier = "poll";
			$list_column = "title";
			$url_column = "id";
			break;
		case "people_votes":
			$identifier = "person_vote";
			break;
		case "tables":
			$identifier = "table";
			$list_column = "table_name";
			$url_column = "id";
			break;
		case "news":
			$identifier = "news";
			$list_column = "headline";
			$url_column = "id";
			break;
		case "tags":
			$identifier = "tag";
			break;
		case "people_tags":
			$identifier = "person_tag";
			break;
		case "positions":
			$identifier = "position";
			$list_column = "name";
			$url_column = "id";
			break;
		case "users":
			$identifier = "user";
			$list_column = "username";
			$url_column = "id";
			break;
		case "goals":
			$identifier = "goal";
			break;
		default:
			$identifier = "person";
	}
	
?>
