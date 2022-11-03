<?php

	switch ($table_id) {
		case "people":
			$identifier = "person";
			$list_column = "name";
			$url_column = "file_code";
			$sort_column = "file_code";
			break;
		case "matches":
			$identifier = "match";
			$list_column = "file_code";
			$url_column = "file_code";
			$sort_column = "file_code";
			break;
		case "hall_teams":
			$identifier = "team";
			$list_column = "title";
			$url_column = "file_code";
			$sort_column = "file_code";
			break;
		case "continents":
			$identifier = "continent";
			$list_column = "name";
			$url_column = "id";
			$sort_column = "name";
			break;
		case "countries":
			$identifier = "country";
			$list_column = "display_name";
			$url_column = "id";
			$sort_column = "name";
			break;
		case "teams":
			$identifier = "club";
			$list_column = "name";
			$url_column = "id";
			$sort_column = "name";
			break;
		case "competitions":
			$identifier = "competition";
			$list_column = "name";
			$url_column = "id";
			$sort_column = "name";
			break;
		case "tournaments":
			$identifier = "tournament";
			$list_column = "name";
			$url_column = "id";
			$sort_column = "name";
			break;
		case "stories":
			$identifier = "story";
			$list_column = "title";
			$url_column = "id";
			$sort_column = "name";
			break;
		case "dream_teams":
			$identifier = "dream_team";
			$list_column = "name";
			$url_column = "id";
			$sort_column = "name";
			break;
		case "polls":
			$identifier = "poll";
			$list_column = "title";
			$url_column = "id";
			$sort_column = "id";
			break;
		case "people_votes":
			$identifier = "person_vote";
			$list_column = "option";
			$disambiguation = "poll";
			$url_column = "id";
			$sort_column = "id";
			break;
		case "people_positions":
			$identifier = "person_position";
			$list_column = "position";
			$disambiguation = "person";
			$url_column = "id";
			$sort_column = "id";
			break;
		case "people_dream":
			$identifier = "person_dream";
			$list_column = "dream_team";
			$disambiguation = "person";
			$url_column = "id";
			$sort_column = "id";
			break;
		case "people_matches":
			$identifier = "person_match";
			$list_column = "match_code";
			$disambiguation = "person";
			$url_column = "id";
			$sort_column = "id";
			break;
		case "people_teams":
			$identifier = "person_team";
			$list_column = "person";
			$disambiguation = "hall_team";
			$url_column = "id";
			$sort_column = "id";
			break;
		case "match_votes":
			$identifier = "match_vote";
			$list_column = "option";
			$disambiguation = "poll";
			$url_column = "id";
			$sort_column = "id";
			break;
		case "team_votes":
			$identifier = "team_vote";
			$list_column = "option";
			$disambiguation = "poll";
			$url_column = "id";
			$sort_column = "id";
			break;
		case "tables":
			$identifier = "table";
			$list_column = "table_name";
			$url_column = "id";
			$sort_column = "id";
			break;
		case "news":
			$identifier = "news";
			$list_column = "headline";
			$url_column = "id";
			$sort_column = "id";
			break;
		case "tag_list":
			$identifier = "tag";
			$list_column = "table_name";
			$url_column = "id";
			$sort_column = "id";
			break;
		case "positions":
			$identifier = "position";
			$list_column = "name";
			$url_column = "id";
			$sort_column = "id";
			break;
		case "tournament_teams":
			$identifier = "tournament_team";
			$list_column = "team_name";
			$disambiguation = "tournament_name";
			$url_column = "id";
			$sort_column = "id";
			break;
		case "teams_matches":
			$identifier = "team_match";
			$list_column = "match_code";
			$disambiguation = "hall_team";
			$url_column = "id";
			$sort_column = "id";
			break;
		case "users":
			$identifier = "user";
			$list_column = "username";
			$url_column = "id";
			$sort_column = "id";
			break;
		case "goals":
			$identifier = "goal";
			$list_column = "score";
			$disambiguation = "match_code";
			$url_column = "id";
			$sort_column = "id";
			break;
		case "alternative_names":
			$identifier = "alternative";
			$list_column = "alternative";
			$url_column = "id";
			$sort_column = "alternative";
			break;
		default:
			$identifier = "person";
	}
	
?>
