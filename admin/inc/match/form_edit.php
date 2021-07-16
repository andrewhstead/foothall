			<form class="edit-form" method="post" action="edit_record.php?type=matches&code=<?php echo $record_id; ?>">

				<label for="file-code">File Code:</label>
				<input type="text" name="file-code" placeholder="File Code" id="file-code" value="<?php echo $file_code; ?>">
				<br>
				<label for="teams-type">Club/National:</label>
				<input type="text" name="teams-type" placeholder="Club or National?" id="teams-type" value="<?php echo $teams; ?>">
				<br><br>
				<label for="admitted">Admitted:</label>
				<input type="radio" name="status" id="admitted" value="admitted" <?php if ($admitted) { echo 'checked'; } ?>>
				<label for="contender">Contender:</label>
				<input type="radio" name="status" id="contender" value="contender" <?php if ($contender) { echo 'checked'; } ?>>
				<label for="admitted">Inactive:</label>
				<input type="radio" name="status" id="inactive" value="inactive" <?php if (!$admitted and !$contender) { echo 'checked'; } ?>>
				<br>
				<label for="admission-date">Admission Date:</label>
				<input type="date" name="admission-date" placeholder="DD-MM-YYYY" id="admission-date" value="<?php echo $admission_date; ?>">
				<br>
				<label for="admission-poll">Admission Poll:</label>
				<input type="text" name="admission-poll" placeholder="Admitted in Poll..." id="admission-poll" value="<?php echo $admission_poll; ?>">
				<br><br>
				<label for="score">Total Rating Score:</label>
				<input type="text" name="score" placeholder="Total Rating Score..." id="score" value="<?php echo $score; ?>">
				<br>
				<label for="votes">Rating Votes:</label>
				<input type="text" name="votes" placeholder="Rating Votes..." id="votes" value="<?php echo $votes; ?>">
				<br>
				<label for="rating">Average Rating:</label>
				<input type="text" name="rating" placeholder="Average Rating..." id="rating" value="<?php echo $rating; ?>">
				<br><br>
				<label for="match-date">Date:</label>
				<input type="date" name="match-date" placeholder="DD-MM-YYYY" id="match-date" value="<?php echo $date; ?>">
				<br>
				<label for="competition">Competition:</label>
				<input type="text" name="competition" placeholder="Competition" id="competition" value="<?php echo $competition; ?>">
				<br>
				<label for="stage">Stage:</label>
				<input type="text" name="stage" placeholder="Stage" id="stage" value="<?php echo $stage; ?>">
				<br><br>
				<label for="team-1">Team 1:</label>
				<input type="text" name="team-1" placeholder="Team Name" id="team-1" value="<?php echo $team_1; ?>">
				<label for="score-1">Score:</label>
				<input type="text" name="score-1" placeholder="0" id="score-1" value="<?php echo $score_1; ?>">
				<br>
				<label for="team-2">Team 2:</label>
				<input type="text" name="team-2" placeholder="Team Name" id="team-2" value="<?php echo $team_2; ?>">
				<label for="score-2">Score:</label>
				<input type="text" name="score-2" placeholder="0" id="score-2" value="<?php echo $score_2; ?>">
				<br><br>
				<label for="intro-text">Introductory Text:</label>
				<textarea class="editable-area" rows="5" cols="35" name="intro-text"><?php echo $intro_text; ?></textarea>
				<br>
				<label for="match-report">Match Report:</label>
				<textarea class="editable-area" rows="10" cols="35" name="match-report"><?php echo $match_report; ?></textarea>
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
		</form>
